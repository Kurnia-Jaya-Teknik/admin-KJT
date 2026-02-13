<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100 flex flex-col">
        @livewire('navigation-menu')

        <!-- Content Area with Sidebar -->
        <div class="flex flex-1 pt-16">
            {{ $slot }}
        </div>
    </div>

    @stack('modals')

    @stack('scripts')
    @livewireScripts

    <!-- Global Notification Toast Function -->
    <script>
        function showNotification(message, type = 'info') {
            // Create notification container if not exists
            let notification = document.getElementById('globalNotification');
            if (!notification) {
                notification = document.createElement('div');
                notification.id = 'globalNotification';
                notification.className = 'fixed top-4 right-4 max-w-md z-[9999]';
                document.body.appendChild(notification);
            }

            // Determine colors based on type
            let bgColor = 'bg-blue-500';
            let borderColor = 'border-blue-600';
            let icon = '💡';

            if (type === 'success') {
                bgColor = 'bg-green-500';
                borderColor = 'border-green-600';
                icon = '✓';
            } else if (type === 'error') {
                bgColor = 'bg-red-500';
                borderColor = 'border-red-600';
                icon = '✕';
            } else if (type === 'warning') {
                bgColor = 'bg-yellow-500';
                borderColor = 'border-yellow-600';
                icon = '⚠';
            }

            // Create toast element
            const toast = document.createElement('div');
            toast.className =
                `${bgColor} ${borderColor} border text-white rounded-lg shadow-2xl p-4 flex items-center gap-3 animate-in slide-in-from-top fade-in duration-300`;
            toast.innerHTML = `
                <span class="text-xl font-bold">${icon}</span>
                <span class="flex-1 font-medium text-sm">${message}</span>
                <button onclick="this.parentElement.remove()" class="text-white hover:bg-white/20 rounded px-2 py-1 transition-all">×</button>
            `;

            notification.appendChild(toast);

            // Auto remove after 4 seconds
            setTimeout(() => {
                toast.classList.remove('animate-in', 'slide-in-from-top', 'fade-in');
                toast.classList.add('animate-out', 'slide-out-to-top', 'fade-out');
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }

        // Global Confirmation Dialog Function
        function showConfirmation(message, onConfirm, onCancel = null) {
            // Create modal backdrop
            const backdrop = document.createElement('div');
            backdrop.className = 'fixed inset-0 bg-black/50 z-[9998] flex items-center justify-center';

            // Create modal dialog
            const dialog = document.createElement('div');
            dialog.className = 'bg-white rounded-xl shadow-2xl p-6 max-w-sm mx-4 animate-in zoom-in duration-300';
            dialog.innerHTML = `
                <p class="text-gray-800 font-medium mb-6">${message}</p>
                <div class="flex gap-3 justify-end">
                    <button onclick="this.closest('[data-dialog]').remove(); if(window.lastDialogCancel) window.lastDialogCancel();" 
                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-all font-medium">
                        Batal
                    </button>
                    <button onclick="this.closest('[data-dialog]').remove(); if(window.lastDialogConfirm) window.lastDialogConfirm();" 
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all font-medium">
                        Setuju
                    </button>
                </div>
            `;

            dialog.setAttribute('data-dialog', 'true');

            // Store callbacks
            window.lastDialogConfirm = onConfirm;
            window.lastDialogCancel = onCancel;

            // Add to backdrop and show
            backdrop.appendChild(dialog);
            document.body.appendChild(backdrop);

            // Close on backdrop click
            backdrop.addEventListener('click', (e) => {
                if (e.target === backdrop) {
                    backdrop.remove();
                    if (onCancel) onCancel();
                }
            });
        }
    </script>
</body>

</html>
