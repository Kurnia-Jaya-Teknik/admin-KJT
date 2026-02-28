let currentApprovalData = {
    employee: '',
    type: '',
    date: '',
    action: ''
};

// Log when script loads
console.log('direktur-approval.js loaded');

// Check for CSRF token on load
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (csrfToken) {
        console.log('CSRF token found:', csrfToken.getAttribute('content').substring(0, 10) + '...');
    } else {
        console.error('CSRF token NOT found in page');
    }
    
    // Check for modal
    const modal = document.getElementById('approvalModal');
    if (modal) {
        console.log('Approval modal found');
    } else {
        console.error('Approval modal NOT found');
    }
});

function openApprovalModal(employeeName, requestType, requestDate, action, requestId, type) {
    console.log('openApprovalModal called', {employeeName, requestType, requestDate, action, requestId, type});
    
    currentApprovalData = {
        employee: employeeName,
        type: requestType,
        date: requestDate,
        action: action,
        requestId: requestId,
        requestType: type // 'cuti' or 'lembur'
    };

    const modal = document.getElementById('approvalModal');
    if (!modal) {
        console.error('Modal approvalModal not found');
        alert('Modal tidak ditemukan. Silakan refresh halaman.');
        return;
    }

    const actionText = action === 'Approve' ? 'Setujui Pengajuan' : 'Tolak Pengajuan';

    document.getElementById('modalAction').textContent = actionText;
    document.getElementById('modalEmployeeName').textContent = employeeName;
    document.getElementById('modalRequestType').textContent = requestType;
    document.getElementById('modalRequestDate').textContent = requestDate;
    document.getElementById('modalNotes').value = '';

    const btnText = action === 'Approve' ? 'Setujui' : 'Tolak';
    const btnClass = action === 'Approve' ?
        'bg-emerald-600 hover:bg-emerald-700' :
        'bg-red-600 hover:bg-red-700';

    document.getElementById('modalConfirmBtn').textContent = btnText;
    document.getElementById('modalConfirmBtn').className =
        `flex-1 px-4 py-2.5 rounded-lg ${btnClass} text-white font-semibold shadow-md hover:shadow-lg transition-all duration-200`;

    modal.classList.remove('hidden');
    console.log('Modal opened successfully');
}

function closeApprovalModal() {
    document.getElementById('approvalModal').classList.add('hidden');
}

async function confirmApproval() {
    console.log('confirmApproval called');
    const notes = document.getElementById('modalNotes').value;
    const action = currentApprovalData.action;
    const requestId = currentApprovalData.requestId;
    const requestType = currentApprovalData.requestType;

    console.log('Approval data:', {notes, action, requestId, requestType});

    if (!requestId || !requestType) {
        console.error('Invalid request data', {requestId, requestType});
        alert('Data request tidak valid');
        return;
    }

    const endpoint = action === 'Approve' ?
        `/direktur/api/${requestType}/${requestId}/approve` :
        `/direktur/api/${requestType}/${requestId}/reject`;

    console.log('Sending request to:', endpoint);

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        if (!csrfToken) {
            console.error('CSRF token not found');
            alert('CSRF token tidak ditemukan. Silakan refresh halaman.');
            return;
        }

        console.log('CSRF token found:', csrfToken.substring(0, 10) + '...');

        const response = await fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            credentials: 'same-origin',
            body: JSON.stringify({
                keterangan: notes
            })
        });

        console.log('Response status:', response.status);

        if (!response.ok) {
            const body = await response.json().catch(() => ({}));
            console.error('Request failed:', response.status, body);
            // show validation or server errors inline
            const errEl = document.getElementById('approvalError');
            if (errEl) {
                if (response.status === 422 && body.errors) {
                    errEl.textContent = Object.values(body.errors).flat().join(' ') || (body.message ||
                        'Validasi gagal');
                } else {
                    errEl.textContent = body.message || ('Status: ' + response.status);
                }
                errEl.classList.remove('hidden');
            } else {
                alert(body.message || ('Status: ' + response.status));
            }

            return;
        }

        const result = await response.json();
        console.log('Request successful:', result);

        // Show notification with better styling
        const action_type = currentApprovalData.action;
        const jenis = currentApprovalData.type;
        const message = action_type === 'Approve' ?
            `✓ ${jenis} telah disetujui!` :
            `✓ ${jenis} telah ditolak!`;

        // Create and show toast with showNotification function if available
        if (typeof showNotification === 'function') {
            showNotification(message, 'success');
        } else {
            // Fallback toast
            const toast = document.createElement('div');
            toast.className = 'fixed top-6 right-6 z-50 bg-white border rounded-xl p-3 shadow-lg';
            toast.innerHTML =
                `<p class="text-sm font-medium text-gray-800">${result.message || 'Berhasil diproses'}</p>`;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.remove();
            }, 3500);
        }

        closeApprovalModal();

        // Reload page to update list
        console.log('Reloading page...');
        window.location.reload();
    } catch (error) {
        console.error('Error during approval:', error);
        alert('Error: ' + error.message);
    }
}

// Handle confirm/cancel buttons in approval modal
document.addEventListener('click', function(e) {
    // Confirm approval button
    if (e.target && (e.target.classList.contains('btn-confirm-approval') || e.target.id === 'modalConfirmBtn')) {
        e.preventDefault();
        console.log('Confirm button clicked, calling confirmApproval()');
        confirmApproval();
        return;
    }
    
    // Cancel approval button
    if (e.target && e.target.classList.contains('btn-cancel-approval')) {
        e.preventDefault();
        console.log('Cancel button clicked');
        closeApprovalModal();
        return;
    }
});

// Close modals when clicking outside
document.getElementById('approvalModal')?.addEventListener('click', (e) => {
    if (e.target.id === 'approvalModal') {
        closeApprovalModal();
    }
});
document.getElementById('previewModal')?.addEventListener('click', (e) => {
    if (e.target.id === 'previewModal') {
        closePreviewModal();
    }
});

// Auto-open modal when directed from notification link: ?type=cuti&id=123
(function() {
    try {
        const params = new URLSearchParams(window.location.search);
        const id = params.get('id');
        const type = params.get('type');
        if (id && type) {
            // find button with matching data-request-id
            const btn = document.querySelector(`[data-request-id="${id}"]`);
            if (btn) {
                const employee = btn.getAttribute('data-employee-name') || '';
                const jenis = btn.getAttribute('data-jenis') || '';
                const tanggal = btn.getAttribute('data-tanggal') || '';
                // Show Approve modal by default when coming from notification
                openApprovalModal(employee, jenis, tanggal, 'Approve', parseInt(id), type);
                btn.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }
    } catch (e) {
        console.debug('auto-open modal failed', e);
    }
})();

// Preview modal functions for direktur
async function openPreviewModal(requestId, type) {
    try {
        const modal = document.getElementById('previewModal');
        const content = document.getElementById('previewContent');

        if (!modal || !content) {
            console.error('Modal elements not found');
            return;
        }

        content.innerHTML = '<div class="text-sm text-gray-500 p-4">Memuat pratinjau...</div>';
        modal.classList.remove('hidden');

        const res = await fetch(`/direktur/api/${type}/${requestId}/preview`, {
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json'
            }
        });

        if (!res.ok) {
            content.innerHTML = '<div class="text-sm text-red-500 p-4">Gagal memuat pratinjau (Status: ' + res
                .status + ').</div>';
            return;
        }

        const data = await res.json();
        if (data && data.ok && data.html) {
            // Clear first to avoid DOM conflicts
            content.innerHTML = '';
            // Use setTimeout to ensure DOM is ready
            setTimeout(() => {
                content.innerHTML = data.html;
            }, 10);

            // Store context
            window._previewContext = {
                id: requestId,
                type
            };
        } else {
            content.innerHTML = '<div class="text-sm text-red-500 p-4">Pratinjau tidak tersedia.</div>';
        }
    } catch (e) {
        console.error('openPreviewModal error', e);
        const content = document.getElementById('previewContent');
        if (content) {
            content.innerHTML = '<div class="text-sm text-red-500 p-4">Terjadi kesalahan: ' + (e.message ||
                'Unknown error') + '</div>';
        }
    }
}

function closePreviewModal() {
    const modal = document.getElementById('previewModal');
    if (modal) modal.classList.add('hidden');
}

function openImageModal(imageUrl) {
    const modal = document.getElementById('imageModal');
    const img = document.getElementById('imageModalContent');
    if (modal && img) {
        img.src = imageUrl;
        modal.classList.remove('hidden');
    }
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    if (modal) {
        modal.classList.add('hidden');
        // Clear image src to free memory
        const img = document.getElementById('imageModalContent');
        if (img) img.src = '';
    }
}

function openApprovalModalFromPreview() {
    // Get context from preview window
    if (!window._previewContext || !window._previewContext.id || !window._previewContext.type) {
        alert('Context invalid');
        return;
    }
    const {
        id,
        type
    } = window._previewContext;
    closePreviewModal();

    // Find button with this ID and trigger its onclick
    const btn = document.querySelector(`[data-request-id="${id}"][data-request-type="${type}"]`);
    if (btn) {
        const employee = btn.getAttribute('data-employee-name') || '';
        const jenis = btn.getAttribute('data-jenis') || '';
        const tanggal = btn.getAttribute('data-tanggal') || '';
        openApprovalModal(employee, jenis, tanggal, 'Approve', parseInt(id), type);
    } else {
        alert('Tidak menemukan pengajuan');
    }
}

// Delegated click handler for all buttons
document.addEventListener('click', function(e) {
    try {
        // ensure we have an Element to call closest on (handle text node clicks)
        const targetEl = (e.target && e.target.nodeType === 3) ? e.target.parentElement : e.target;
        
        // Modal control buttons
        if (targetEl && targetEl.classList) {
            // Close approval modal
            if (targetEl.classList.contains('btn-cancel-approval')) {
                closeApprovalModal();
                return;
            }
            
            // Confirm approval
            if (targetEl.classList.contains('btn-confirm-approval')) {
                confirmApproval();
                return;
            }
            
            // Close preview modal
            if (targetEl.classList.contains('btn-close-preview')) {
                closePreviewModal();
                return;
            }
            
            // Approve from preview
            if (targetEl.classList.contains('btn-approve-from-preview')) {
                openApprovalModalFromPreview();
                return;
            }
        }
        
        // Preview button
        const btnPreview = targetEl && targetEl.closest ? targetEl.closest('.btn-preview') : null;
        if (btnPreview) {
            e.preventDefault();
            e.stopPropagation();
            const id = btnPreview.getAttribute('data-request-id');
            const type = btnPreview.getAttribute('data-request-type');
            if (id && type) {
                openPreviewModal(id, type);
            }
            return;
        }
        
        // Approve button
        const btnApprove = targetEl && targetEl.closest ? targetEl.closest('.btn-approve') : null;
        if (btnApprove) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Approve button clicked', btnApprove);
            const id = btnApprove.getAttribute('data-request-id');
            const type = btnApprove.getAttribute('data-request-type');
            const employeeName = btnApprove.getAttribute('data-employee-name');
            const jenis = btnApprove.getAttribute('data-jenis');
            const tanggal = btnApprove.getAttribute('data-tanggal');
            console.log('Button data:', {id, type, employeeName, jenis, tanggal});
            if (id && type && employeeName && jenis && tanggal) {
                openApprovalModal(employeeName, jenis, tanggal, 'Approve', parseInt(id), type);
            } else {
                console.error('Missing button attributes', {id, type, employeeName, jenis, tanggal});
                alert('Data button tidak lengkap. Silakan refresh halaman.');
            }
            return;
        }
        
        // Reject button
        const btnReject = targetEl && targetEl.closest ? targetEl.closest('.btn-reject') : null;
        if (btnReject) {
            e.preventDefault();
            e.stopPropagation();
            const id = btnReject.getAttribute('data-request-id');
            const type = btnReject.getAttribute('data-request-type');
            const employeeName = btnReject.getAttribute('data-employee-name');
            const jenis = btnReject.getAttribute('data-jenis');
            const tanggal = btnReject.getAttribute('data-tanggal');
            if (id && type && employeeName && jenis && tanggal) {
                openApprovalModal(employeeName, jenis, tanggal, 'Reject', parseInt(id), type);
            }
            return;
        }
        
        // Image button
        const btnImage = targetEl && targetEl.closest ? targetEl.closest('.btn-image') : null;
        if (btnImage) {
            const imageUrl = btnImage.getAttribute('data-image-url');
            if (imageUrl) {
                openImageModal(imageUrl);
            }
            return;
        }
    } catch (err) {
        console.error('button click handler error:', err);
        alert('Terjadi error: ' + err.message);
    }
});
