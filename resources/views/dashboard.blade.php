<x-app-layout>
    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:pr-8 lg:pl-4 lg:py-8 bg-gray-50/50 min-h-full">
            <!-- Welcome Banner -->
            @if (Auth::user()->role === 'karyawan')
                <div
                    class="relative overflow-hidden bg-gradient-to-r from-slate-400 via-slate-400 to-slate-500 rounded-2xl p-6 mb-6 shadow-lg">
                    <div class="relative flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-xl font-bold mb-1 text-white">Halo, {{ Auth::user()->name }}! 👋</h1>
                                <p class="text-slate-50 text-sm font-medium">
                                    {{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
                                <div class="mt-2">
                                    <span
                                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-slate-50 text-sm">
                                        <svg class="w-3.5 h-3.5 text-slate-50" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Status Absensi:
                                            <strong
                                                id="dashboardAbsensiStatus">{{ $statusAbsensi ?? 'Belum Absen' }}</strong></span>
                                    </span>

                                    <div class="mt-3 flex items-center gap-3">
                                        <button id="dashboardBtnCheckIn" aria-pressed="false" title="Absen Masuk"
                                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white text-green-700 font-semibold shadow-sm transition-all transform hover:-translate-y-0.5 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-300">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M12 6v6l3 3" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M21 12A9 9 0 1112 3v3" />
                                            </svg>
                                            <span class="hidden sm:inline">Absen Masuk</span>
                                        </button>

                                        <button id="dashboardBtnCheckOut" aria-pressed="false" title="Absen Pulang"
                                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white text-red-600 font-semibold shadow-sm transition-all transform hover:-translate-y-0.5 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-300 opacity-70">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M12 18v-6l-3-3" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M3 12a9 9 0 1018 0" />
                                            </svg>
                                            <span class="hidden sm:inline">Absen Pulang</span>
                                        </button>

                                        <div class="ml-3">
                                            <span id="dashboardAbsensiMsg" aria-live="polite"
                                                class="text-sm text-white/80 transition-opacity block"></span>
                                            <div id="dashboardAbsensiDebug" class="text-xs text-white/70 mt-2 hidden"
                                                style="max-width:420px;white-space:pre-wrap;word-break:break-word;">
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        (function() {
                                            function setAbsensiMsg(text, isError = false) {
                                                const el = document.getElementById('dashboardAbsensiMsg');
                                                if (!el) return;
                                                el.textContent = text;
                                                el.classList.remove('text-green-200', 'text-red-200');
                                                el.classList.add(isError ? 'text-red-200' : 'text-green-200');
                                                el.style.opacity = '1';
                                                // hide after 2s
                                                setTimeout(() => {
                                                    try {
                                                        el.style.opacity = '0';
                                                        setTimeout(() => el.textContent = '', 400);
                                                    } catch (e) {}
                                                }, 2000);
                                            }

                                            function setAbsensiDebug(obj) {
                                                const el = document.getElementById('dashboardAbsensiDebug');
                                                if (!el) return;
                                                try {
                                                    el.textContent = JSON.stringify(obj, null, 2);
                                                    el.classList.remove('hidden');
                                                    setTimeout(() => el.classList.add('hidden'), 8000);
                                                } catch (e) {
                                                    el.textContent = String(obj);
                                                }
                                            }

                                            async function fetchToday() {
                                                try {
                                                    const res = await fetch('/karyawan/api/absensi/today', {
                                                        credentials: 'same-origin',
                                                        headers: {
                                                            'Accept': 'application/json'
                                                        }
                                                    });
                                                    if (!res.ok) {
                                                        // show message when unauthorized or session expired
                                                        if (res.status === 401 || res.status === 419) {
                                                            const msg = document.getElementById('dashboardAbsensiMsg');
                                                            if (msg) msg.innerText = 'Sesi berakhir. Silakan login ulang.';
                                                        }
                                                        return;
                                                    }
                                                    const data = await res.json();
                                                    const a = data.absensi;
                                                    const statusEl = document.getElementById('dashboardAbsensiStatus');
                                                    const btnIn = document.getElementById('dashboardBtnCheckIn');
                                                    const btnOut = document.getElementById('dashboardBtnCheckOut');
                                                    const msgEl = document.getElementById('dashboardAbsensiMsg');

                                                    if (btnIn) {
                                                        btnIn.disabled = false;
                                                        btnIn.classList.remove('opacity-40', 'cursor-not-allowed');
                                                        btnIn.setAttribute('aria-disabled', 'false');
                                                    }
                                                    if (btnOut) {
                                                        btnOut.disabled = true;
                                                        btnOut.classList.add('opacity-40', 'cursor-not-allowed');
                                                        btnOut.setAttribute('aria-disabled', 'true');
                                                    }

                                                    if (!a) {
                                                        if (statusEl) statusEl.innerText = 'Belum Absen';
                                                        if (btnIn) {
                                                            btnIn.disabled = false;
                                                            btnIn.classList.remove('opacity-40', 'cursor-not-allowed');
                                                            btnIn.setAttribute('aria-disabled', 'false');
                                                        }
                                                        if (btnOut) {
                                                            btnOut.disabled = true;
                                                            btnOut.classList.add('opacity-40', 'cursor-not-allowed');
                                                            btnOut.setAttribute('aria-disabled', 'true');
                                                        }
                                                        if (msgEl) msgEl.textContent = '';
                                                        return;
                                                    }

                                                    if (statusEl) statusEl.innerText = a.status || 'Hadir';
                                                    if (a.jam_masuk && !a.jam_keluar) {
                                                        if (btnIn) {
                                                            btnIn.disabled = true;
                                                            btnIn.classList.add('opacity-40', 'cursor-not-allowed');
                                                            btnIn.setAttribute('aria-disabled', 'true');
                                                        }
                                                        if (btnOut) {
                                                            btnOut.disabled = false;
                                                            btnOut.classList.remove('opacity-40', 'cursor-not-allowed');
                                                            btnOut.setAttribute('aria-disabled', 'false');
                                                        }
                                                    } else if (a.jam_masuk && a.jam_keluar) {
                                                        if (btnIn) {
                                                            btnIn.disabled = true;
                                                            btnIn.classList.add('opacity-40', 'cursor-not-allowed');
                                                            btnIn.setAttribute('aria-disabled', 'true');
                                                        }
                                                        if (btnOut) {
                                                            btnOut.disabled = true;
                                                            btnOut.classList.add('opacity-40', 'cursor-not-allowed');
                                                            btnOut.setAttribute('aria-disabled', 'true');
                                                        }
                                                    }

                                                } catch (err) {
                                                    // ignore silently
                                                }
                                            }

                                            async function postAction(path, btn) {
                                                try {
                                                    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
                                                    const token = tokenMeta ? tokenMeta.getAttribute('content') : '';
                                                    if (!btn) return;
                                                    btn.disabled = true;
                                                    btn.classList.add('opacity-40', 'cursor-not-allowed');
                                                    btn.setAttribute('aria-disabled', 'true');

                                                    const res = await fetch(path, {
                                                        method: 'POST',
                                                        credentials: 'same-origin',
                                                        headers: {
                                                            'Accept': 'application/json',
                                                            'X-CSRF-TOKEN': token,
                                                            'X-Requested-With': 'XMLHttpRequest'
                                                        }
                                                    });
                                                    const body = await res.json().catch(() => ({}));
                                                    // Debug: show request/response in debug panel
                                                    setAbsensiDebug({
                                                        url: path,
                                                        status: res.status,
                                                        body: body
                                                    });
                                                    if (!res.ok) {
                                                        if (res.status === 401 || res.status === 419) {
                                                            setAbsensiMsg('Sesi berakhir. Silakan login ulang.', true);
                                                            return;
                                                        }
                                                        setAbsensiMsg(body.message || 'Terjadi kesalahan', true);
                                                    } else {
                                                        setAbsensiMsg(body.message || 'Sukses', false);
                                                        await fetchToday();
                                                        // notify dashboard to refresh charts
                                                        try {
                                                            document.dispatchEvent(new Event('attendance:changed'));
                                                        } catch (e) {}
                                                    }
                                                } catch (err) {
                                                    setAbsensiMsg('Gagal koneksi', true);
                                                } finally {
                                                    if (btn) {
                                                        btn.disabled = false;
                                                        btn.classList.remove('opacity-40', 'cursor-not-allowed');
                                                        btn.setAttribute('aria-disabled', 'false');
                                                    }
                                                }
                                            }

                                            document.addEventListener('DOMContentLoaded', function() {
                                                const cIn = document.getElementById('dashboardBtnCheckIn');
                                                const cOut = document.getElementById('dashboardBtnCheckOut');
                                                cIn?.addEventListener('click', function(e) {
                                                    postAction('/karyawan/api/absensi/checkin', e.currentTarget);
                                                });
                                                cOut?.addEventListener('click', function(e) {
                                                    postAction('/karyawan/api/absensi/checkout', e.currentTarget);
                                                });
                                                fetchToday();
                                            });
                                        })();
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div
                    class="relative overflow-hidden bg-gradient-to-r from-slate-400 via-slate-400 to-slate-500 rounded-2xl p-8 mb-8 shadow-lg">
                    <div class="relative flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold mb-2 text-white">Selamat Datang, {{ Auth::user()->name }}!
                                    👋</h1>
                                <p class="text-slate-50 text-sm">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-24 h-24 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                @if (Auth::user()->role === 'direktur')
                    <!-- Direktur Stats -->
                    <div
                        class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-slate-600 bg-slate-100 px-2 py-1 rounded-full">Aktif</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">156</h3>
                        <p class="text-sm text-gray-500">Total Karyawan Aktif</p>
                    </div>

                    <div
                        class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full">Pending</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">8</h3>
                        <p class="text-sm text-gray-500">Cuti Menunggu Approval</p>
                    </div>

                    <div
                        class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-purple-600 bg-purple-100 px-2 py-1 rounded-full">Pending</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">5</h3>
                        <p class="text-sm text-gray-500">Lembur Menunggu Approval</p>
                    </div>

                    <div
                        class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-red-600 bg-red-100 px-2 py-1 rounded-full">Proses</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">3</h3>
                        <p class="text-sm text-gray-500">Surat Menunggu Proses</p>
                    </div>
                @elseif(Auth::user()->role === 'admin_hrd')
                    <!-- Admin HRD Stats -->
                    <div
                        class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">+12%</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">156</h3>
                        <p class="text-sm text-gray-500">Total Karyawan</p>
                    </div>

                    <div
                        class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">92%</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">143</h3>
                        <p class="text-sm text-gray-500">Hadir Hari Ini</p>
                    </div>

                    <div
                        class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full">Approved</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">24</h3>
                        <p class="text-sm text-gray-500">Pengajuan Disetujui</p>
                    </div>

                    <div
                        class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-purple-600 bg-purple-100 px-2 py-1 rounded-full">Draft</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">8</h3>
                        <p class="text-sm text-gray-500">Surat Siap Dikirim</p>
                    </div>
                @else
                    <!-- Karyawan Stats - Personal (Soft Modern Design) -->
                    <div
                        class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-5 shadow-sm hover:shadow-md border border-gray-100/50 transition-all duration-300 hover:-translate-y-0.5">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-red-50/50 to-slate-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-red-600 bg-red-50 px-2.5 py-1 rounded-full">Tersisa</span>
                        </div>

                        <h3 id="sisaCuti" class="text-2xl font-semibold text-gray-800 mb-1">{{ $sisaCuti ?? 0 }}</h3>
                        <p class="text-sm text-gray-500 font-medium">Sisa Cuti Tahun Ini</p>

                        <div class="mt-4">
                            <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                                <div id="cutiProgressFill"
                                    class="h-2 bg-gradient-to-r from-red-400 to-red-500 transition-all"
                                    style="width: 0%"></div>
                            </div>
                            <div class="flex items-center justify-between mt-2 text-xs text-gray-500">
                                <div>Digunakan: <span id="cutiDipakaiSmall">{{ $cutiDipakai ?? 0 }}</span> hari</div>
                                <div><span id="cutiProgressLabel">0%</span> dari <span
                                        id="cutiEntitlementSmall">{{ $cutiEntitlement ?? config('leave.cuti_tahunan_default', 20) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-5 shadow-sm hover:shadow-md border border-gray-100/50 transition-all duration-300 hover:-translate-y-0.5">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-slate-50/50 to-gray-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-slate-100 to-gray-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-slate-600 bg-slate-50 px-2.5 py-1 rounded-full">Digunakan</span>
                        </div>
                        <h3 id="cutiDipakai" class="text-2xl font-semibold text-gray-800 mb-1">{{ $cutiDipakai ?? 0 }}
                        </h3>
                        <p class="text-sm text-gray-500 font-medium">Cuti Dipakai Tahun Ini <span
                                class="text-xs text-gray-400">(disetujui)</span></p>

                        <div class="mt-3 flex items-center gap-3 flex-wrap max-w-full">
                            <div class="text-xs text-gray-600 mr-2">Permintaan:</div>
                            <div id="badgeApproved"
                                class="text-xs inline-flex items-center whitespace-nowrap px-3 py-1 rounded-full bg-emerald-100 text-emerald-700">
                                {{ $cutiApprovedCount ?? 0 }} Disetujui</div>
                            <div id="badgePending"
                                class="text-xs inline-flex items-center whitespace-nowrap px-3 py-1 rounded-full bg-yellow-100 text-yellow-800">
                                {{ $cutiPendingCount ?? 0 }} Menunggu</div>
                            <div id="badgeRejected"
                                class="text-xs inline-flex items-center whitespace-nowrap px-3 py-1 rounded-full bg-red-100 text-red-700">
                                {{ $cutiRejectedCount ?? 0 }} Ditolak</div>
                        </div>
                    </div>

                    <div
                        class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-5 shadow-sm hover:shadow-md border border-gray-100/50 transition-all duration-300 hover:-translate-y-0.5">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-red-50/50 to-orange-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-100 to-orange-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-red-600 bg-red-50 px-2.5 py-1 rounded-full">Pengajuan
                                Menunggu</span>
                        </div>
                        <h3 id="pendingRequests" class="text-2xl font-semibold text-gray-800 mb-1">
                            {{ $pendingRequests ?? 0 }}</h3>
                        <p class="text-sm text-gray-500 font-medium">Pengajuan belum diproses</p>
                    </div>



                    <div
                        class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-5 shadow-sm hover:shadow-md border border-gray-100/50 transition-all duration-300 hover:-translate-y-0.5">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-green-50/50 to-emerald-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-100 to-emerald-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-green-600 bg-green-50 px-2.5 py-1 rounded-full">Disetujui</span>
                        </div>
                        <h3 id="statusTerakhirText" class="text-xl font-semibold text-gray-800 mb-1">-</h3>
                        <p class="text-sm text-gray-500 font-medium">Status Pengajuan Terakhir</p>
                    </div>
                @endif
            </div>

            <!-- Live Data Lists -->
            <div class="bg-white rounded-xl p-4 mb-6 border border-gray-100">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-lg font-semibold">Daftar Pengajuan Terbaru</h3>
                    <div class="flex items-center gap-3">
                        <div id="dashboardSpinner" class="flex items-center gap-2 text-sm text-gray-500"
                            style="display:none;">
                            <svg class="w-4 h-4 animate-spin text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                </path>
                            </svg>
                            <span id="dashboardLoadingText">Memuat...</span>
                        </div>
                        <div id="dashboardMessage" class="text-sm text-red-600"></div>
                        <div class="text-xs text-gray-400" id="dashboardLastUpdated">-</div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Pengajuan Cuti (terbaru)</h4>
                        <ul id="latestCutiList" class="text-sm text-gray-700 list-disc pl-5">
                            <li class="text-xs text-gray-400">Memuat...</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Surat Terbaru</h4>
                        <ul id="latestLettersList" class="text-sm text-gray-700 list-disc pl-5">
                            <li class="text-xs text-gray-400">Memuat...</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                @if (Auth::user()->role === 'direktur')
                    <!-- Charts Section - Direktur (2 kolom) -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Pengajuan Bulan Ini Chart - Simpel -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengajuan per Bulan (6 Bulan Terakhir)
                            </h3>
                            <div id="monthlyBars" class="flex items-end justify-between h-40 gap-2 mb-6">
                                <div id="bar0" class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-red-600 rounded-t bar-fill" style="height: 0px;"></div>
                                    <span id="label0" class="text-xs text-gray-600 font-medium">-</span>
                                </div>
                                <div id="bar1" class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-red-600 rounded-t bar-fill" style="height: 0px;"></div>
                                    <span id="label1" class="text-xs text-gray-600 font-medium">-</span>
                                </div>
                                <div id="bar2" class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-red-600 rounded-t bar-fill" style="height: 0px;"></div>
                                    <span id="label2" class="text-xs text-gray-600 font-medium">-</span>
                                </div>
                                <div id="bar3" class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-red-600 rounded-t bar-fill" style="height: 0px;"></div>
                                    <span id="label3" class="text-xs text-gray-600 font-medium">-</span>
                                </div>
                                <div id="bar4" class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-red-600 rounded-t bar-fill" style="height: 0px;"></div>
                                    <span id="label4" class="text-xs text-gray-600 font-medium">-</span>
                                </div>
                                <div id="bar5" class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-red-600 rounded-t bar-fill" style="height: 0px;"></div>
                                    <span id="label5" class="text-xs text-gray-600 font-medium">-</span>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-gray-100">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-600">Jumlah Pengajuan Saat Ini</span>
                                    <span id="totalSubmissions" class="text-lg font-bold text-indigo-600">-</span>
                                </div>
                            </div>
                        </div>

                        <!-- Lembur Per Divisi - Progress Bar Sederhana -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Lembur per Divisi (Bulan Ini)</h3>
                            <div class="space-y-4">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700">IT & Teknologi</span>
                                        <span class="text-sm font-bold text-red-600">42 jam</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-red-600 h-2 rounded-full" style="width: 60%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700">Finance</span>
                                        <span class="text-sm font-bold text-slate-600">35 jam</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-slate-600 h-2 rounded-full" style="width: 50%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700">Operations</span>
                                        <span class="text-sm font-bold text-emerald-600">31 jam</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-emerald-600 h-2 rounded-full" style="width: 44%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 pt-3 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Total Lembur</span>
                                <span class="text-lg font-bold text-gray-800">150 jam</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column Charts - Direktur -->
                    <div class="space-y-6">
                        <!-- Status Pengajuan Donut FULL 360° - SOLID COLOR -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6">Status Pengajuan</h3>
                            <div class="flex items-center justify-center mb-6">
                                <div class="relative w-48 h-48">
                                    <svg class="w-full h-full" viewBox="0 0 140 140"
                                        style="transform: rotate(-90deg)">
                                        <!-- Approved (green) - 60/140 = 43% = 154.8° -->
                                        <circle cx="70" cy="70" r="55" fill="none" stroke="#059669"
                                            stroke-width="22" stroke-dasharray="119.3 340.6"
                                            stroke-linecap="round" />
                                        <!-- Pending (amber) - 70/140 = 50% = 180° -->
                                        <circle cx="70" cy="70" r="55" fill="none" stroke="#d97706"
                                            stroke-width="22" stroke-dasharray="136 340.6" stroke-dashoffset="-119.3"
                                            stroke-linecap="round" />
                                        <!-- Rejected (red) - 10/140 = 7% = 25.2° -->
                                        <circle cx="70" cy="70" r="55" fill="none" stroke="#dc2626"
                                            stroke-width="22" stroke-dasharray="24.4 340.6"
                                            stroke-dashoffset="-255.3" stroke-linecap="round" />
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="text-center">
                                            <div class="text-3xl font-bold text-gray-800">140</div>
                                            <div class="text-xs text-gray-500">Total</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div class="flex items-center justify-between p-2 rounded hover:bg-gray-50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-4 h-4 rounded-full bg-green-600 flex-shrink-0"></div>
                                        <span class="text-gray-600">Disetujui</span>
                                    </div>
                                    <span class="font-bold text-gray-800">60 (43%)</span>
                                </div>
                                <div class="flex items-center justify-between p-2 rounded hover:bg-gray-50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-4 h-4 rounded-full bg-yellow-600 flex-shrink-0"></div>
                                        <span class="text-gray-600">Menunggu</span>
                                    </div>
                                    <span class="font-bold text-gray-800">70 (50%)</span>
                                </div>
                                <div class="flex items-center justify-between p-2 rounded hover:bg-gray-50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-4 h-4 rounded-full bg-red-600 flex-shrink-0"></div>
                                        <span class="text-gray-600">Ditolak</span>
                                    </div>
                                    <span class="font-bold text-gray-800">10 (7%)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Ringkasan Harian - Minimal & Fokus -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-9">Ringkasan Hari Ini</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100 mt-5">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600 font-bold">Pengajuan Pending</span>
                                    </div>
                                    <span class="font-bold text-lg text-yellow-600">13</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600 font-bold">Disetujui (Bulan Ini)</span>
                                    </div>
                                    <span class="font-bold text-lg text-green-600">60</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600 font-bold">Ditolak (Bulan Ini)</span>
                                    </div>
                                    <span class="font-bold text-lg text-red-600">10</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600 font-bold">Kehadiran Hari Ini</span>
                                    </div>
                                    <span class="font-bold text-lg text-slate-600">145/156</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif(Auth::user()->role === 'admin_hrd')
                    <!-- Charts Section - Admin HRD -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Kehadiran per Divisi - Vertical Bar Chart -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6">Kehadiran per Divisi (Hari Ini)</h3>

                            <!-- Chart Container -->
                            <div class="flex gap-6 items-end border-l-2 border-b-2 border-gray-300 pl-6 pb-6 pt-4"
                                style="height: 320px;">
                                <!-- IT & Teknologi -->
                                <div class="flex-1 flex flex-col items-center justify-end gap-3">
                                    <div class="w-full bg-slate-500 rounded-t-lg" style="height: 180px;"></div>
                                    <div class="text-center">
                                        <p class="text-xs font-semibold text-gray-700 mb-1">IT & Teknologi</p>
                                        <p class="text-sm font-bold text-slate-600">18/20</p>
                                    </div>
                                </div>

                                <!-- Finance -->
                                <div class="flex-1 flex flex-col items-center justify-end gap-3">
                                    <div class="w-full bg-green-500 rounded-t-lg" style="height: 250px;"></div>
                                    <div class="text-center">
                                        <p class="text-xs font-semibold text-gray-700 mb-1">Finance</p>
                                        <p class="text-sm font-bold text-green-600">25/25</p>
                                    </div>
                                </div>

                                <!-- Operations -->
                                <div class="flex-1 flex flex-col items-center justify-end gap-3">
                                    <div class="w-full bg-yellow-500 rounded-t-lg" style="height: 190px;"></div>
                                    <div class="text-center">
                                        <p class="text-xs font-semibold text-gray-700 mb-1">Operations</p>
                                        <p class="text-sm font-bold text-yellow-600">38/45</p>
                                    </div>
                                </div>

                                <!-- Marketing -->
                                <div class="flex-1 flex flex-col items-center justify-end gap-3">
                                    <div class="w-full bg-indigo-500 rounded-t-lg" style="height: 210px;"></div>
                                    <div class="text-center">
                                        <p class="text-xs font-semibold text-gray-700 mb-1">Marketing</p>
                                        <p class="text-sm font-bold text-red-600">28/30</p>
                                    </div>
                                </div>

                                <!-- HRD -->
                                <div class="flex-1 flex flex-col items-center justify-end gap-3">
                                    <div class="w-full bg-slate-500 rounded-t-lg" style="height: 250px;"></div>
                                    <div class="text-center">
                                        <p class="text-xs font-semibold text-gray-700 mb-1">HRD</p>
                                        <p class="text-sm font-bold text-slate-600">10/10</p>
                                    </div>
                                </div>
                            </div>



                            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Total Kehadiran Hari Ini</span>
                                <span class="text-lg font-bold text-green-600">143/156 (92%)</span>
                            </div>
                        </div>

                        <!-- Pengajuan Masuk Chart -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6">Pengajuan Masuk (6 Bulan Terakhir)
                            </h3>

                            <!-- Chart Container -->
                            <div class="flex gap-4 items-end border-b-2 border-gray-300 pb-4" style="height: 240px;">
                                <!-- Agustus -->
                                <div class="flex-1 flex flex-col items-center justify-end gap-2">
                                    <div class="w-full bg-indigo-500 rounded-t-lg" style="height: 140px;"></div>
                                    <span class="text-xs text-gray-700 font-medium mt-2">Agu</span>
                                </div>

                                <!-- September -->
                                <div class="flex-1 flex flex-col items-center justify-end gap-2">
                                    <div class="w-full bg-indigo-500 rounded-t-lg" style="height: 170px;"></div>
                                    <span class="text-xs text-gray-700 font-medium mt-2">Sep</span>
                                </div>

                                <!-- Oktober -->
                                <div class="flex-1 flex flex-col items-center justify-end gap-2">
                                    <div class="w-full bg-indigo-500 rounded-t-lg" style="height: 120px;"></div>
                                    <span class="text-xs text-gray-700 font-medium mt-2">Okt</span>
                                </div>

                                <!-- November -->
                                <div class="flex-1 flex flex-col items-center justify-end gap-2">
                                    <div class="w-full bg-indigo-500 rounded-t-lg" style="height: 190px;"></div>
                                    <span class="text-xs text-gray-700 font-medium mt-2">Nov</span>
                                </div>

                                <!-- Desember -->
                                <div class="flex-1 flex flex-col items-center justify-end gap-2">
                                    <div class="w-full bg-indigo-500 rounded-t-lg" style="height: 210px;"></div>
                                    <span class="text-xs text-gray-700 font-medium mt-2">Des</span>
                                </div>

                                <!-- Januari -->
                                <div class="flex-1 flex flex-col items-center justify-end gap-2">
                                    <div class="w-full bg-indigo-600 rounded-t-lg" style="height: 150px;"></div>
                                    <span class="text-xs text-gray-700 font-medium mt-2">Jan</span>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-gray-100 flex items-center justify-between mt-4">
                                <span class="text-sm font-medium text-gray-600">Total 6 Bulan</span>
                                <span class="text-lg font-bold text-indigo-600">342 pengajuan</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Admin HRD Summary -->
                    <div class="space-y-6">
                        <!-- Status Pengajuan - Pie Chart -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Pengajuan</h3>
                            <div class="flex items-center gap-6 mb-2">
                                <!-- Pie (Chart.js canvas) -->
                                <div class="relative w-40 h-40 flex items-center justify-center">
                                    <canvas id="statusPie" width="160" height="160" class="w-40 h-40"></canvas>
                                    <!-- Smaller center chip so it doesn't cover the doughnut -->
                                    <div id="statusTotal"
                                        class="absolute inset-0 m-auto flex flex-col items-center justify-center z-10 pointer-events-none">
                                        <div class="bg-white rounded-full px-3 py-2 shadow-sm text-center">
                                            <div class="text-lg font-bold text-gray-800 leading-none">89</div>
                                            <div class="text-xs text-gray-500 -mt-0.5">Total</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Legend & Counts -->
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-3 h-3 rounded-full bg-green-600"></div>
                                            <span class="text-sm text-gray-700">Disetujui</span>
                                        </div>
                                        <div id="countApproved" class="text-sm font-bold text-gray-800">45</div>
                                    </div>

                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-3 h-3 rounded-full bg-yellow-600"></div>
                                            <span class="text-sm text-gray-700">Menunggu</span>
                                        </div>
                                        <div id="countPending" class="text-sm font-bold text-gray-800">36</div>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-3 h-3 rounded-full bg-red-600"></div>
                                            <span class="text-sm text-gray-700">Ditolak</span>
                                        </div>
                                        <div id="countRejected" class="text-sm font-bold text-gray-800">8</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Chart.js Script (CDN) -->
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                (function() {
                                    const approved = 45;
                                    const pending = 36;
                                    const rejected = 8;
                                    const total = approved + pending + rejected;
                                    // set total display (safe selector fallback)
                                    const totalEl = document.getElementById('statusTotal');
                                    if (totalEl) {
                                        const numEl = totalEl.querySelector('.text-2xl') || totalEl.querySelector('.text-lg') || totalEl
                                            .querySelector('.font-bold') || totalEl.querySelector('div');
                                        if (numEl) numEl.textContent = total;
                                    }

                                    // prepare chart
                                    const ctx = document.getElementById('statusPie').getContext('2d');
                                    // destroy existing chart instance if present (hot reload)
                                    if (window._statusPieChart) {
                                        window._statusPieChart.destroy();
                                    }
                                    window._statusPieChart = new Chart(ctx, {
                                        type: 'doughnut',
                                        data: {
                                            labels: ['Disetujui', 'Menunggu', 'Ditolak'],
                                            datasets: [{
                                                data: [approved, pending, rejected],
                                                backgroundColor: ['#059669', '#d97706', '#dc2626'],
                                                hoverOffset: 8
                                            }]
                                        },
                                        options: {
                                            cutout: '60%',
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            plugins: {
                                                legend: {
                                                    display: false
                                                },
                                                tooltip: {
                                                    mode: 'index',
                                                    intersect: false
                                                }
                                            }
                                        }
                                    });
                                })();
                            </script>
                        </div>

                        <!-- Kuota Cuti Saya -->
                        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 mt-5">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Kuota Cuti Saya</h3>

                            @php
                                $pct =
                                    $cutiEntitlement && $cutiEntitlement > 0
                                        ? min(100, round((($sisaCuti ?? 0) / $cutiEntitlement) * 100))
                                        : 0;
                            @endphp

                            <div class="space-y-4">
                                <!-- Cuti Tahunan -->
                                <div>
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm text-gray-700">Cuti Tahunan</div>
                                        <div class="text-sm font-semibold text-red-600">{{ $sisaCuti ?? 0 }} /
                                            {{ $cutiEntitlement ?? 0 }} hari</div>
                                    </div>
                                    <div class="mt-3 bg-gray-100 rounded-full h-3.5 overflow-hidden">
                                        @php
                                            $pct =
                                                $cutiEntitlement && $cutiEntitlement > 0
                                                    ? min(100, round((($sisaCuti ?? 0) / $cutiEntitlement) * 100))
                                                    : 0;
                                        @endphp
                                        <div class="h-3.5 bg-red-500 rounded-full"
                                            style="width: {{ $pct }}%"></div>
                                    </div>
                                </div>

                                <!-- Cuti Sakit -->
                                <div>
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm text-gray-700">Cuti Sakit</div>
                                        <div class="text-sm font-semibold text-slate-800">Tidak Terbatas</div>
                                    </div>
                                    <div class="mt-3 bg-gray-100 rounded-full h-3.5 overflow-hidden">
                                        <div class="h-3.5 bg-slate-700 rounded-full" style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ringkasan Surat -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Surat</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Menunggu Proses</span>
                                    <span class="font-bold text-lg text-yellow-600">5</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Sedang Diproses</span>
                                    <span class="font-bold text-lg text-blue-600">3</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Siap Dikirim</span>
                                    <span class="font-bold text-lg text-purple-600">8</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Dikirim Bulan Ini</span>
                                    <span class="font-bold text-lg text-green-600">24</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Charts Section - Karyawan (Personal) - Soft Modern Design -->
                    <div class="lg:col-span-2 space-y-5">
                        <!-- Personal Attendance Chart - Monthly (improved) -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-base font-semibold text-gray-800">Kehadiran Saya - <span
                                        id="attendanceMonthLabel">-</span></h3>
                                <div class="flex items-center gap-4">
                                    <span id="attendanceSummary"
                                        class="text-xs font-medium text-gray-600 bg-gray-100 px-2.5 py-1 rounded-full">-
                                        / - Hari</span>
                                    <div class="flex items-center gap-3 text-xs">
                                        <div class="flex items-center gap-2"><span
                                                class="w-3 h-3 rounded-sm bg-emerald-400 inline-block"></span><span
                                                class="text-gray-600">Hadir</span></div>
                                        <div class="flex items-center gap-2"><span
                                                class="w-3 h-3 rounded-sm bg-indigo-400 inline-block"></span><span
                                                class="text-gray-600">Cuti</span></div>
                                        <div class="flex items-center gap-2"><span
                                                class="w-3 h-3 rounded-sm bg-yellow-400 inline-block"></span><span
                                                class="text-gray-600">Izin/Sakit</span></div>
                                        <div class="flex items-center gap-2"><span
                                                class="w-3 h-3 rounded-sm bg-slate-400 inline-block"></span><span
                                                class="text-gray-600">Alpa</span></div>
                                    </div>
                                </div>
                            </div>

                            <div id="attendanceChart" class="h-48 flex items-end gap-2 px-2 overflow-x-auto py-2">
                                <!-- Bars will be rendered here -->
                            </div>

                            <div class="mt-5 grid grid-cols-3 gap-4 pt-4 border-t border-gray-100">
                                <div class="text-center">
                                    <p class="text-gray-500 mb-1 text-xs font-medium">Hadir</p>
                                    <p id="attendanceCountPresent" class="font-semibold text-lg text-emerald-600">-
                                    </p>
                                </div>
                                <div class="text-center">
                                    <p class="text-gray-500 mb-1 text-xs font-medium">Tidak Hadir</p>
                                    <p id="attendanceCountAlpa" class="font-semibold text-lg text-slate-600">-</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-gray-500 mb-1 text-xs font-medium">Setengah Hari</p>
                                    <p id="attendanceCountHalf" class="font-semibold text-lg text-yellow-600">-</p>
                                </div>
                            </div>
                        </div>

                        <!-- Pengajuan Cuti Chart - 6 Bulan Terakhir -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-6">
                            <h3 class="text-base font-semibold text-gray-800 mb-6">Pengajuan Cuti Saya - 6 Bulan
                                Terakhir</h3>
                            <!-- Chart dengan Grid Lines dan Layout Lebih Besar -->
                            <div class="space-y-4">
                                <!-- Y-axis scale labels -->
                                <div class="flex gap-6">
                                    <div class="w-12 flex flex-col justify-between text-right pr-2"
                                        style="height: 280px;">
                                        <span class="text-xs text-gray-500 font-medium">4</span>
                                        <span class="text-xs text-gray-500 font-medium">3</span>
                                        <span class="text-xs text-gray-500 font-medium">2</span>
                                        <span class="text-xs text-gray-500 font-medium">1</span>
                                        <span class="text-xs text-gray-500 font-medium">0</span>
                                    </div>
                                    <!-- Main Chart Container -->
                                    <div class="flex-1">
                                        <div class="relative" style="height: 280px;">
                                            <!-- Grid lines -->
                                            <div
                                                class="absolute inset-0 flex flex-col justify-between pointer-events-none">
                                                <div class="border-t border-gray-200"></div>
                                                <div class="border-t border-gray-200"></div>
                                                <div class="border-t border-gray-200"></div>
                                                <div class="border-t border-gray-200"></div>
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                            <!-- Bars Container -->
                                            <div class="absolute inset-0 flex items-end justify-around gap-6 px-2">
                                                <!-- Agustus -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-red-600 hover:bg-red-700 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 75%; max-width: 80px; margin: 0 auto;"
                                                        title="3 hari">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">3</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Agu</span>
                                                </div>
                                                <!-- September -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-red-600 hover:bg-red-700 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 50%; max-width: 80px; margin: 0 auto;"
                                                        title="2 hari">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">2</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Sep</span>
                                                </div>
                                                <!-- Oktober -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-red-600 hover:bg-red-700 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 100%; max-width: 80px; margin: 0 auto;"
                                                        title="4 hari">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">4</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Okt</span>
                                                </div>
                                                <!-- November -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-red-600 hover:bg-red-700 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 25%; max-width: 80px; margin: 0 auto; min-height: 12px;"
                                                        title="1 hari">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-0.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">1</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Nov</span>
                                                </div>
                                                <!-- Desember -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-gray-400 hover:bg-gray-500 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 5%; max-width: 80px; margin: 0 auto; min-height: 8px;"
                                                        title="0 hari"></div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Des</span>
                                                </div>
                                                <!-- Januari -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-red-700 hover:bg-red-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 50%; max-width: 80px; margin: 0 auto;"
                                                        title="2 hari">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">2</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Jan</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Total Cuti Digunakan</span>
                                <span class="text-lg font-semibold text-yellow-600">12 hari</span>
                            </div>
                        </div>

                        <!-- Personal Overtime Chart -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-6">
                            <h3 class="text-base font-semibold text-gray-800 mb-6">Lembur Saya - 6 Bulan Terakhir</h3>
                            <!-- Chart dengan Grid Lines dan Layout Lebih Besar -->
                            <div class="space-y-4">
                                <!-- Y-axis scale labels -->
                                <div class="flex gap-6">
                                    <div class="w-12 flex flex-col justify-between text-right pr-2"
                                        style="height: 280px;">
                                        <span class="text-xs text-gray-500 font-medium">14h</span>
                                        <span class="text-xs text-gray-500 font-medium">10h</span>
                                        <span class="text-xs text-gray-500 font-medium">7h</span>
                                        <span class="text-xs text-gray-500 font-medium">3h</span>
                                        <span class="text-xs text-gray-500 font-medium">0h</span>
                                    </div>
                                    <!-- Main Chart Container -->
                                    <div class="flex-1">
                                        <div class="relative" style="height: 280px;">
                                            <!-- Grid lines -->
                                            <div
                                                class="absolute inset-0 flex flex-col justify-between pointer-events-none">
                                                <div class="border-t border-gray-200"></div>
                                                <div class="border-t border-gray-200"></div>
                                                <div class="border-t border-gray-200"></div>
                                                <div class="border-t border-gray-200"></div>
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                            <!-- Bars Container -->
                                            <div class="absolute inset-0 flex items-end justify-around gap-6 px-2">
                                                <!-- Agustus -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-slate-700 hover:bg-slate-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 85.7%; max-width: 80px; margin: 0 auto;"
                                                        title="12 jam">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">12h</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Agu</span>
                                                </div>
                                                <!-- September -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-slate-700 hover:bg-slate-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 57%; max-width: 80px; margin: 0 auto;"
                                                        title="8 jam">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">8h</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Sep</span>
                                                </div>
                                                <!-- Oktober -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-slate-700 hover:bg-slate-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 71%; max-width: 80px; margin: 0 auto;"
                                                        title="10 jam">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">10h</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Okt</span>
                                                </div>
                                                <!-- November -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-slate-700 hover:bg-slate-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 42.8%; max-width: 80px; margin: 0 auto; min-height: 12px;"
                                                        title="6 jam">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-0.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">6h</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Nov</span>
                                                </div>
                                                <!-- Desember -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-slate-700 hover:bg-slate-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 100%; max-width: 80px; margin: 0 auto;"
                                                        title="14 jam">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">14h</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Des</span>
                                                </div>
                                                <!-- Januari -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-slate-800 hover:bg-slate-900 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 114%; max-width: 80px; margin: 0 auto;"
                                                        title="16 jam">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">16h</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Jan</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Total 6 Bulan Terakhir</span>
                                <span class="text-lg font-semibold text-purple-600">66 jam</span>
                            </div>
                        </div>

                        <!-- Status Pengajuan Chart (Donut/Pie) -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-6">
                            <h3 class="text-base font-semibold text-gray-800 mb-5">Status Pengajuan Saya</h3>
                            <div class="flex flex-col md:flex-row items-center justify-center gap-6">
                                <!-- Donut Chart Visual - Fixed Calculation -->
                                <div class="relative w-36 h-36 flex-shrink-0">
                                    <svg class="w-36 h-36 transform -rotate-90" viewBox="0 0 120 120">
                                        <!-- Background circle -->
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="#e5e7eb"
                                            stroke-width="12" />
                                        <!-- Disetujui (60% = 188.5 dari 314.16) -->
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="#10b981"
                                            stroke-width="12" stroke-dasharray="188.5 314.16" stroke-dashoffset="0"
                                            stroke-linecap="round" />
                                        <!-- Menunggu (25% = 78.54 dari 314.16) -->
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="#f59e0b"
                                            stroke-width="12" stroke-dasharray="78.54 314.16"
                                            stroke-dashoffset="-188.5" stroke-linecap="round" />
                                        <!-- Ditolak (15% = 47.12 dari 314.16) -->
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="#ef4444"
                                            stroke-width="12" stroke-dasharray="47.12 314.16"
                                            stroke-dashoffset="-267.04" stroke-linecap="round" />
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                        <div class="text-center">
                                            <div class="text-2xl font-semibold text-gray-800">20</div>
                                            <div class="text-xs text-gray-500">Total</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Legend -->
                                <div class="space-y-3 flex-shrink-0">
                                    <div class="flex items-center gap-3">
                                        <div class="w-3 h-3 rounded-full bg-green-500 flex-shrink-0"></div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-800">Disetujui</p>
                                            <p class="text-xs text-gray-500">12 (60%)</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-3 h-3 rounded-full bg-red-500 flex-shrink-0"></div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-800">Menunggu</p>
                                            <p class="text-xs text-gray-500">5 (25%)</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-3 h-3 rounded-full bg-red-500 flex-shrink-0"></div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-800">Ditolak</p>
                                            <p class="text-xs text-gray-500">3 (15%)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Karyawan (Personal) - Soft Modern Design -->
                    <div class="space-y-5">
                        <!-- Cuti Balance Quick View -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-5">
                            <h3 class="text-sm font-semibold text-gray-800 mb-4">Kuota Cuti Saya</h3>
                            <div class="space-y-4">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-medium text-gray-600">Cuti Tahunan</span>
                                        <span class="text-sm font-semibold text-red-600">12 / 20 hari</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-red-500 to-red-600 h-2 rounded-full transition-all duration-500"
                                            style="width: 60%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-medium text-gray-600">Cuti Sakit</span>
                                        <span class="text-sm font-semibold text-slate-600">Tidak Terbatas</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-slate-500 to-slate-600 h-2 rounded-full transition-all duration-500"
                                            style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Summary -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-5">
                            <h3 class="text-sm font-semibold text-gray-800 mb-4">Info Saya</h3>
                            <div class="space-y-3 text-sm">
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-gray-500 font-medium">Bagian</span>
                                    <span class="font-semibold text-gray-800">IT & Teknologi</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-gray-500 font-medium">Status</span>
                                    <span class="font-semibold text-gray-800">Tetap</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-gray-500 font-medium">Kehadiran Bulan Ini</span>
                                    <span class="font-semibold text-lg text-red-600">100%</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-500 font-medium">Menunggu Persetujuan</span>
                                    <span class="font-semibold text-lg text-slate-600">1</span>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions Card -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-5">
                            <h3 class="text-sm font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                            <div class="space-y-3">
                                <a href="{{ route('karyawan.pengajuan-cuti') }}"
                                    class="block w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-medium text-sm py-2.5 px-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 text-center">
                                    Ajukan Cuti
                                </a>
                                <a href="{{ route('karyawan.pengajuan-lembur') }}"
                                    class="block w-full bg-gradient-to-r from-slate-600 to-slate-700 hover:from-slate-700 hover:to-slate-800 text-white font-medium text-sm py-2.5 px-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 text-center">
                                    Ajukan Lembur
                                </a>
                                <a href="{{ route('karyawan.surat') }}"
                                    class="block w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-medium text-sm py-2.5 px-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 text-center">
                                    Surat Saya
                                </a>
                            </div>
                        </div>

                        <!-- Pengajuan Pending -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-5">
                            <h3 class="text-sm font-semibold text-gray-800 mb-4">Pengajuan Menunggu</h3>
                            <div class="space-y-3">
                                <div
                                    class="flex items-center justify-between p-3 bg-red-50/50 rounded-lg border border-red-100/50">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-800">Cuti Tahunan</p>
                                            <p class="text-xs text-gray-500">2 hari - 15-16 Jan</p>
                                        </div>
                                    </div>
                                    <span
                                        class="text-xs font-medium text-red-600 bg-red-100 px-2 py-0.5 rounded-full">Pending</span>
                                </div>
                                <div
                                    class="flex items-center justify-between p-3 bg-slate-50/50 rounded-lg border border-slate-100/50">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-slate-500"></div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-800">Lembur</p>
                                            <p class="text-xs text-gray-500">5 jam - 12 Jan</p>
                                        </div>
                                    </div>
                                    <span
                                        class="text-xs font-medium text-slate-600 bg-slate-100 px-2 py-0.5 rounded-full">Review</span>
                                </div>
                            </div>
                            <a href="{{ route('karyawan.riwayat') }}"
                                class="mt-3 block text-center text-xs font-medium text-slate-600 hover:text-slate-700">
                                Lihat Semua →
                            </a>
                        </div>

                        <!-- Statistik Bulanan -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-5">
                            <h3 class="text-sm font-semibold text-gray-800 mb-4">Statistik Bulan Ini</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-medium text-gray-600">Kehadiran</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-800">90.9%</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-medium text-gray-600">Total Lembur</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-800">16 jam</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-medium text-gray-600">Cuti Digunakan</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-800">2 hari</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-medium text-gray-600">Surat Terbit</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-800">1</span>
                                </div>
                            </div>
                        </div>

                        <!-- Notifikasi Penting -->
                        <div
                            class="bg-gradient-to-br from-red-50/50 to-slate-50/30 rounded-xl shadow-sm border border-red-100/50 p-5">
                            <div class="flex items-center gap-2 mb-3">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <h3 class="text-sm font-semibold text-gray-800">Pemberitahuan</h3>
                            </div>
                            <div class="space-y-2">
                                <div class="text-xs text-gray-600 leading-relaxed">
                                    <p class="font-medium text-gray-800 mb-1">• Slip gaji Desember tersedia</p>
                                    <p class="text-gray-500">Silakan unduh di menu Surat Saya</p>
                                </div>
                                <div class="text-xs text-gray-600 leading-relaxed pt-2 border-t border-red-100/50">
                                    <p class="font-medium text-gray-800 mb-1">• Evaluasi kinerja Q4</p>
                                    <p class="text-gray-500">Jadwal: 20 Januari 2026</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Dashboard API Script -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const apiUrl = '/api/employee/dashboard';
                    const setText = (id, text) => {
                        const el = document.getElementById(id);
                        if (el) el.innerText = text;
                    };
                    const spinner = document.getElementById('dashboardSpinner');
                    const loadingText = document.getElementById('dashboardLoadingText');
                    const lastUpdatedEl = document.getElementById('dashboardLastUpdated');

                    function showSpinner(msg = 'Memuat...') {
                        try {
                            if (spinner) {
                                spinner.style.display = 'inline-flex';
                            }
                            if (loadingText) loadingText.innerText = msg;
                            console.log('[dashboard] showSpinner', msg);
                        } catch (e) {
                            console.warn('showSpinner error', e);
                        }
                    }

                    function hideSpinner() {
                        try {
                            if (spinner) spinner.style.display = 'none';
                            console.log('[dashboard] hideSpinner');
                        } catch (e) {
                            console.warn('hideSpinner error', e);
                        }
                    }

                    function updateLastUpdated() {
                        if (lastUpdatedEl) lastUpdatedEl.innerText = 'Terakhir: ' + new Date().toLocaleTimeString('id-ID');
                    }

                    function escapeHtml(str) {
                        if (!str && str !== 0) return '';
                        return String(str).replace(/[&<>"'`=\/]/g, function(s) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": "&#39;",
                    "/": "\/",
                    "=`": "&#61;"
                            } [s] || s;
                        });
                    }

                    function formatDate(dateStr) {
                        try {
                            if (!dateStr) return '';
                            const d = new Date(dateStr);
                            return d.toLocaleDateString('id-ID', {
                                day: 'numeric',
                                month: 'short',
                                year: 'numeric'
                            });
                        } catch (e) {
                            return dateStr;
                        }
                    }

                    function statusClass(status) {
                        if (!status) return 'bg-gray-100 text-gray-600';
                        const s = String(status).toLowerCase();
                        if (s.includes('disetujui') || s.includes('approved')) return 'bg-emerald-100 text-emerald-700';
                        if (s.includes('pending') || s.includes('menunggu')) return 'bg-yellow-100 text-yellow-800';
                        if (s.includes('ditolak') || s.includes('rejected')) return 'bg-red-100 text-red-700';
                        return 'bg-gray-100 text-gray-600';
                    }

                    function renderList(elId, items, emptyHtml) {
                        const el = document.getElementById(elId);
                        if (!el) return;
                        el.innerHTML = '';
                        if (!items || !items.length) {
                            el.innerHTML = `<li class="text-xs text-gray-400">${emptyHtml}</li>`;
                            return;
                        }
                        items.forEach(i => {
                            const li = document.createElement('li');
                            if (elId === 'latestCutiList') {
                                const mulai = formatDate(i.tanggal_mulai);
                                const selesai = formatDate(i.tanggal_selesai);
                                const range = mulai && selesai ? `${mulai} — ${selesai}` : (mulai || selesai ||
                                    '-');
                                const status = i.status ? escapeHtml(i.status) : '';
                                li.innerHTML = `
                                    <div class="flex items-start justify-between">
                                        <div class="mr-4">
                                            <div class="text-sm font-medium text-gray-800">${escapeHtml(i.jenis || 'Cuti')}</div>
                                            <div class="text-xs text-gray-500 mt-0.5">${range}</div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <span class="text-xs px-2 py-0.5 rounded-full ${statusClass(status)}">${status}</span>
                                        </div>
                                    </div>`;
                            } else {
                                const jenis = escapeHtml(i.jenis || 'Surat');
                                const created = i.created_at ? formatDate(i.created_at) : '';
                                li.innerHTML =
                                    `<div class="flex items-center justify-between"><div class="text-sm text-gray-800">${jenis}</div><div class="text-xs text-gray-500">${created}</div></div>`;
                            }
                            el.appendChild(li);
                        });
                    }

                    function fetchAndRender() {
                        showSpinner();
                        fetch(apiUrl, {
                                credentials: 'same-origin',
                                headers: {
                                    'Accept': 'application/json'
                                }
                            })
                            .then(res => {
                                // If server responds 401, try retrying with token taken from localStorage (dev/testing fallback)
                                if (res.status === 401) {
                                    const token = localStorage.getItem('token');
                                    if (token) {
                                        console.log('[dashboard] 401 received - retrying with token from localStorage');
                                        return fetch(apiUrl, {
                                                credentials: 'same-origin',
                                                headers: {
                                                    'Accept': 'application/json',
                                                    'Authorization': 'Bearer ' + token
                                                }
                                            })
                                            .then(r2 => {
                                                if (!r2.ok) throw r2;
                                                return r2.json();
                                            });
                                    }
                                    throw res; // no token available
                                }
                                if (!res.ok) throw res;
                                return res.json();
                            })
                            .then(data => {
                                // show used days this year and remaining (if available)
                                setText('cutiDipakai', (data.counts && data.counts.cuti_used_year) ? data.counts
                                    .cuti_used_year : 0);
                                if (data.counts && data.counts.sisa_cuti !== undefined) {
                                    setText('sisaCuti', data.counts.sisa_cuti);
                                }

                                // update cuti progress (used / entitlement)
                                try {
                                    const used = (data.counts && data.counts.cuti_used_year) ? data.counts
                                        .cuti_used_year : 0;
                                    const entitlement = (data.counts && data.counts.cuti_entitlement) ? data.counts
                                        .cuti_entitlement : (window.cutiEntDefault || 20);
                                    const pct = entitlement > 0 ? Math.round((used / entitlement) * 100) : 0;
                                    const fill = document.getElementById('cutiProgressFill');
                                    if (fill) fill.style.width = pct + '%';
                                    setText('cutiProgressLabel', pct + '%');
                                    setText('cutiDipakaiSmall', used);
                                    setText('cutiEntitlementSmall', entitlement);

                                    // badges counts (if available from API)
                                    if (data.counts) {
                                        setText('badgeApproved', (data.counts.cuti_approved_count !== undefined) ? data
                                            .counts.cuti_approved_count + ' Disetujui' : (document.getElementById(
                                                'badgeApproved')?.innerText || '0 Disetujui'));
                                        setText('badgePending', (data.counts.cuti_pending_count !== undefined) ? data
                                            .counts.cuti_pending_count + ' Menunggu' : (document.getElementById(
                                                'badgePending')?.innerText || '0 Menunggu'));
                                        setText('badgeRejected', (data.counts.cuti_rejected_count !== undefined) ? data
                                            .counts.cuti_rejected_count + ' Ditolak' : (document.getElementById(
                                                'badgeRejected')?.innerText || '0 Ditolak'));
                                    }

                                    // pending requests summary (cuti + lembur)
                                    const pending = (data.counts ? ((data.counts.cuti_pending || 0) + (data.counts
                                        .lembur_pending || 0)) : (document.getElementById('pendingRequests')
                                        ?.innerText || 0));
                                    setText('pendingRequests', pending);

                                    // status pill update
                                    const last = (data.latest_cuti && data.latest_cuti[0]) ? data.latest_cuti[0] : null;
                                    if (last) {
                                        setText('statusTerakhirText', last.status || '-');
                                        const pill = document.getElementById('statusLastPill');
                                        if (pill) {
                                            const s = String(last.status).toLowerCase();
                                            pill.className = 'text-xs font-medium px-2.5 py-0.5 rounded-full';
                                            if (s.includes('disetujui')) {
                                                pill.classList.add('text-emerald-700', 'bg-emerald-50');
                                                pill.innerText = 'Disetujui';
                                            } else if (s.includes('pending') || s.includes('menunggu')) {
                                                pill.classList.add('text-yellow-800', 'bg-yellow-100');
                                                pill.innerText = 'Menunggu';
                                            } else if (s.includes('ditolak') || s.includes('rejected')) {
                                                pill.classList.add('text-red-700', 'bg-red-50');
                                                pill.innerText = 'Ditolak';
                                            } else {
                                                pill.classList.add('text-slate-600', 'bg-slate-50');
                                                pill.innerText = last.status;
                                            }
                                        }
                                    }
                                } catch (e) {
                                    console.warn('cuti progress update failure', e);
                                }
                                setText('totalLembur', (data.counts && data.counts.lembur_pending) ? data.counts
                                    .lembur_pending : 0);
                                setText('statusTerakhirText', (data.latest_cuti && data.latest_cuti.length) ? (data
                                    .latest_cuti[0].status || '-') : '-');
                                renderList('latestCutiList', data.latest_cuti || [], 'Tidak ada pengajuan.');
                                renderList('latestLettersList', data.latest_letters || [], 'Tidak ada surat.');

                                // render monthly bars if provided
                                if (data.monthly_submissions && data.monthly_submissions.length) {
                                    const months = data.monthly_submissions;
                                    let total = 0;
                                    // find max for scaling
                                    const max = Math.max(...months.map(m => m.count), 1);
                                    months.forEach((m, idx) => {
                                        const bar = document.getElementById('bar' + idx);
                                        const label = document.getElementById('label' + idx);
                                        if (bar && label) {
                                            const fill = bar.querySelector('.bar-fill');
                                            const h = Math.round((m.count / max) * 120); // up to 120px
                                            if (fill) fill.style.height = h + 'px';
                                            label.innerText = m.label;
                                        }
                                        total += m.count;
                                    });
                                    const totalEl = document.getElementById('totalSubmissions');
                                    if (totalEl) totalEl.innerText = total;
                                }

                                // render attendance chart if provided
                                if (data.attendance) {
                                    try {
                                        const att = data.attendance;
                                        const chart = document.getElementById('attendanceChart');
                                        const summary = document.getElementById('attendanceSummary');
                                        const monthLabel = document.getElementById('attendanceMonthLabel');
                                        const cntPresentEl = document.getElementById('attendanceCountPresent');
                                        const cntAlpaEl = document.getElementById('attendanceCountAlpa');
                                        const cntHalfEl = document.getElementById('attendanceCountHalf');

                                        if (monthLabel && att.month_label) monthLabel.innerText = att.month_label;
                                        if (summary) summary.innerText = `${att.present} / ${att.working_days} Hari`;

                                        // compute counts defensively
                                        const days = att.days || [];
                                        const presentCount = att.present || days.filter(d => (d.status || '')
                                            .toLowerCase() === 'hadir').length;
                                        const alpaCount = days.filter(d => (d.status || '').toLowerCase() === 'alpa')
                                            .length;
                                        const halfCount = days.filter(d => ((d.status || '').toLowerCase().includes(
                                            'setengah'))).length;

                                        if (cntPresentEl) cntPresentEl.innerText = presentCount;
                                        if (cntAlpaEl) cntAlpaEl.innerText = alpaCount;
                                        if (cntHalfEl) cntHalfEl.innerText = halfCount;

                                        if (chart) {
                                            chart.innerHTML = '';
                                            days.forEach(d => {
                                                const wrapper = document.createElement('div');
                                                wrapper.className =
                                                    'flex flex-col items-center gap-1 min-w-[28px] group';

                                                const bar = document.createElement('div');
                                                bar.className =
                                                    'w-full rounded-t-lg transition-all duration-200 transform';
                                                bar.style.transformOrigin = 'bottom';

                                                let h = '6%';
                                                let title = d.status || 'Alpa';
                                                if (d.jam_masuk || d.jam_keluar) {
                                                    const jm = d.jam_masuk ? 'Masuk: ' + d.jam_masuk : '';
                                                    const jk = d.jam_keluar ? (jm ? ' • Pulang: ' + d
                                                        .jam_keluar : 'Pulang: ' + d.jam_keluar) : '';
                                                    title = `${d.status}${jm || jk ? ' — ' : ''}${jm}${jk}`;
                                                }

                                                // status -> height & color mapping (consistent)
                                                if ((d.status || '').toLowerCase() === 'hadir') {
                                                    h = '100%';
                                                    bar.classList.add('bg-emerald-400');
                                                } else if ((d.status || '').toLowerCase() === 'cuti') {
                                                    h = '100%';
                                                    bar.classList.add('bg-indigo-400');
                                                } else if ((d.status || '').toLowerCase() === 'alpa') {
                                                    h = '6%';
                                                    bar.classList.add('bg-slate-400');
                                                } else if ((d.status || '').toLowerCase().includes(
                                                        'setengah')) {
                                                    h = '50%';
                                                    bar.classList.add('bg-yellow-400');
                                                } else {
                                                    // izin/sakit/others
                                                    h = '80%';
                                                    bar.classList.add('bg-yellow-400');
                                                }

                                                bar.setAttribute('style', `height: ${h}; min-height: 6px`);
                                                bar.setAttribute('title', `${d.date} — ${title}`);
                                                bar.setAttribute('role', 'img');
                                                bar.setAttribute('aria-label', `${d.date}: ${title}`);

                                                // hover effect using mouse events to ensure consistent behavior
                                                wrapper.addEventListener('mouseenter', () => {
                                                    try {
                                                        bar.style.transform = 'scaleY(1.06)';
                                                    } catch (e) {}
                                                });
                                                wrapper.addEventListener('mouseleave', () => {
                                                    try {
                                                        bar.style.transform = '';
                                                    } catch (e) {}
                                                });

                                                const label = document.createElement('span');
                                                label.className = 'text-xs text-gray-600 font-medium';
                                                label.innerText = d.day;

                                                wrapper.appendChild(bar);
                                                wrapper.appendChild(label);
                                                chart.appendChild(wrapper);
                                            });

                                            // ensure chart scrolls a bit to show today if within month
                                            try {
                                                const todayIdx = days.findIndex(dd => dd.date === (new Date())
                                                    .toISOString().slice(0, 10));
                                                if (todayIdx >= 0) {
                                                    const child = chart.children[todayIdx];
                                                    if (child) child.scrollIntoView({
                                                        behavior: 'smooth',
                                                        inline: 'center'
                                                    });
                                                }
                                            } catch (e) {}
                                        }
                                    } catch (e) {
                                        console.warn('attendance render failed', e);
                                    }
                                }

                                updateLastUpdated();
                            })
                            .catch(err => {
                                if (err && err.status === 401) {
                                    console.error('[dashboard] Unauthorized (401). Please login.');
                                    setText('statusTerakhirText', 'Belum login');
                                    renderList('latestCutiList', [], 'Belum login.');
                                    renderList('latestLettersList', [], 'Belum login.');
                                    // show login hint and retry
                                    if (document.getElementById('dashboardMessage')) {
                                        document.getElementById('dashboardMessage').innerText = '';
                                    }
                                } else {
                                    console.error('Gagal memuat dashboard API', err);
                                    setText('statusTerakhirText', 'Tidak tersedia');
                                    renderList('latestCutiList', [], 'Gagal memuat.');
                                    renderList('latestLettersList', [], 'Gagal memuat.');
                                    if (document.getElementById('dashboardMessage')) document.getElementById(
                                        'dashboardMessage').innerText = 'Gagal memuat data. Coba periksa koneksi.';
                                }
                            })
                            .finally(() => {
                                hideSpinner();
                            });
                    }

                    // Auto-refresh feature removed


                    // initial load
                    fetchAndRender();
                    // listen for updates from other widgets (e.g., attendance actions)
                    document.addEventListener('attendance:changed', function() {
                        fetchAndRender();
                    });
                });
            </script>

            <!-- Pending Requests - Direktur (Card Format) -->
            @if (Auth::user()->role === 'direktur')
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <!-- Pengajuan Cuti - Card List Format -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-green-50">
                            <h3 class="text-lg font-bold text-gray-800">Cuti Menunggu Persetujuan (5)</h3>
                        </div>
                        <div class="divide-gray-100 max-h-96 overflow-y-auto">
                            <!-- Card Item 1 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0 font-semibold text-indigo-600">
                                        AR</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Ahmad Rizki</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">IT & Teknologi</p>
                                        <p class="text-xs font-medium text-gray-700">3 hari • Mulai 10 Jan</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 2 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 font-semibold text-blue-600">
                                        BS</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Budi Santoso</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Finance</p>
                                        <p class="text-xs font-medium text-gray-700">2 hari • Mulai 12 Jan</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 3 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 font-semibold text-green-600">
                                        DH</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Dani Hermawan</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Operations</p>
                                        <p class="text-xs font-medium text-gray-700">5 hari • Mulai 15 Jan</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 4 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0 font-semibold text-orange-600">
                                        EW</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Eka Wijaya</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Marketing</p>
                                        <p class="text-xs font-medium text-gray-700">1 hari • Mulai 16 Jan</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 5 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0 font-semibold text-red-600">
                                        FR</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Fitra Rahman</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">HR & Admin</p>
                                        <p class="text-xs font-medium text-gray-700">4 hari • Mulai 18 Jan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 text-center">
                            <a href="{{ route('direktur.persetujuan-cuti-lembur') }}"
                                class="text-sm font-semibold text-green-600 hover:text-green-700">Lihat Semua →</a>
                        </div>
                    </div>

                    <!-- Pengajuan Lembur - Card List Format -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden ">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-purple-50">
                            <h3 class="text-lg font-bold text-gray-800">Lembur Menunggu Persetujuan (5)</h3>
                        </div>
                        <div class="divide-gray-100 max-h-96 overflow-y-auto">
                            <!-- Card Item 1 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0 font-semibold text-indigo-600">
                                        SN</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Siti Nurhaliza</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">IT & Teknologi</p>
                                        <p class="text-xs font-medium text-gray-700">5 jam • 5 Jan 2026</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 2 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 font-semibold text-blue-600">
                                        RW</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Rina Wijaya</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Finance</p>
                                        <p class="text-xs font-medium text-gray-700">4 jam • 6 Jan 2026</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 3 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 font-semibold text-green-600">
                                        GM</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Gusril Maulana</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Operations</p>
                                        <p class="text-xs font-medium text-gray-700">6 jam • 6 Jan 2026</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 4 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0 font-semibold text-orange-600">
                                        HK</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Hendra Kusuma</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Marketing</p>
                                        <p class="text-xs font-medium text-gray-700">3 jam • 7 Jan 2026</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 5 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0 font-semibold text-red-600">
                                        IP</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Intan Permata</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">HR & Admin</p>
                                        <p class="text-xs font-medium text-gray-700">2 jam • 7 Jan 2026</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 text-center">
                            <a href="{{ route('direktur.persetujuan-cuti-lembur') }}"
                                class="text-sm font-semibold text-purple-600 hover:text-purple-700">Lihat Semua →</a>
                        </div>
                    </div>
                </div>
            @elseif(Auth::user()->role === 'admin_hrd')
                <!-- Pending Requests - Admin HRD -->
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <!-- Surat Menunggu Proses -->
                    <div id="surat-card"
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-purple-50">
                            <h3 class="text-lg font-bold text-gray-800">Surat Menunggu Proses (<span
                                    id="surat-count">{{ $suratMenunggu->count() }}</span>)</h3>
                        </div>
                        <div id="surat-list" class="divide-gray-100 max-h-80 overflow-y-auto">
                            @forelse($suratMenunggu as $surat)
                                <div class="px-6 py-4 hover:bg-gray-50 transition-colors"
                                    data-id="{{ $surat->id }}">
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 font-semibold text-blue-600">
                                            {{ strtoupper(substr($surat->user->name, 0, 2)) }}</div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between mb-1">
                                                <p class="text-sm font-semibold text-gray-800">
                                                    {{ $surat->user->name }}
                                                </p>
                                                <span
                                                    class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800 status-label">{{ $surat->status }}</span>
                                            </div>
                                            <p class="text-xs text-gray-500 mb-1">{{ $surat->jenis ?? 'Surat' }}</p>
                                            <p class="text-xs font-medium text-gray-700">Diajukan
                                                {{ $surat->created_at->format('d M Y') }}</p>

                                            <div class="mt-3 flex items-center gap-2 flex-wrap">
                                                <button data-action="view"
                                                    class="px-3 py-1 text-xs rounded-md bg-gray-100 hover:bg-gray-200">Lihat</button>

                                                <button data-action="approve"
                                                    class="px-3 py-1 text-xs rounded-md bg-green-100 text-green-700 hover:bg-green-200">Setujui</button>

                                                <button data-action="reject"
                                                    class="px-3 py-1 text-xs rounded-md bg-red-100 text-red-700 hover:bg-red-200">Tolak</button>

                                                <button data-action="delete"
                                                    class="px-3 py-1 text-xs rounded-md bg-gray-50 text-red-600 hover:bg-red-100">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="px-6 py-4 text-sm text-gray-500">Tidak ada surat menunggu.</div>
                            @endforelse
                        </div>
                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 text-center">
                            <a href="{{ route('admin.surat') }}"
                                class="text-sm font-semibold text-purple-600 hover:text-purple-700">Kelola Surat →</a>
                        </div>
                    </div>

                    <!-- JS handlers: approve/reject/delete and modal close -->
                    <script>
                        (function() {
                            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                            const list = document.getElementById('surat-list');
                            const countEl = document.getElementById('surat-count');

                            function setCount(delta) {
                                if (!countEl) return;
                                const cur = parseInt(countEl.textContent) || 0;
                                countEl.textContent = Math.max(0, cur + (delta || 0));
                            }

                            async function post(url, data) {
                                const res = await fetch(url, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrf,
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify(data || {})
                                });
                                return res.ok ? res.json() : Promise.reject(await res.json());
                            }

                            async function del(url) {
                                const res = await fetch(url, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': csrf,
                                        'Accept': 'application/json'
                                    }
                                });
                                return res.ok ? res.json() : Promise.reject(await res.json());
                            }

                            // delegate click events on list
                            list && list.addEventListener('click', function(e) {
                                const btn = e.target.closest('[data-action]');
                                if (!btn) return;
                                const action = btn.getAttribute('data-action');
                                const item = btn.closest('[data-id]');
                                if (!item) return;
                                const id = item.getAttribute('data-id');

                                if (action === 'approve') {
                                    if (!confirm('Setujui surat ini?')) return;
                                    post(`/admin/surat/${id}/approve`).then(() => {
                                        item.remove();
                                        setCount(-1);
                                    }).catch(() => alert('Gagal menyetujui'));
                                }

                                if (action === 'reject') {
                                    const reason = prompt('Alasan penolakan (wajib):');
                                    if (!reason) return alert('Alasan dibutuhkan');
                                    post(`/admin/surat/${id}/reject`, {
                                        keterangan: reason
                                    }).then(() => {
                                        item.remove();
                                        setCount(-1);
                                    }).catch(() => alert('Gagal menolak'));
                                }

                                if (action === 'delete') {
                                    if (!confirm('Hapus surat ini?')) return;
                                    del(`/admin/surat/${id}`).then(() => {
                                        item.remove();
                                        setCount(-1);
                                    }).catch(() => alert('Gagal menghapus'));
                                }

                                if (action === 'view') {
                                    const modal = document.getElementById('surat-modal-' + id);
                                    if (modal) modal.classList.remove('hidden');
                                }
                            });

                            // modal overlay close
                            document.querySelectorAll('.js-modal').forEach(m => {
                                m.addEventListener('click', function(e) {
                                    if (e.target === this) this.classList.add('hidden');
                                });
                            });
                            document.addEventListener('keydown', function(e) {
                                if (e.key === 'Escape') document.querySelectorAll('.js-modal').forEach(m => m.classList.add(
                                    'hidden'));
                            });

                        })();
                    </script>

                    <!-- Data Karyawan Perlu Perhatian -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
                            <h3 class="text-lg font-bold text-gray-800">Karyawan Perlu Perhatian</h3>
                        </div>
                        <div class="divide-gray-100 max-h-80 overflow-y-auto">
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0 font-semibold text-red-600">
                                        SN</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Siti Nurhaliza</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-red-100 text-red-800">Tidak
                                                Hadir</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">IT & Teknologi</p>
                                        <p class="text-xs font-medium text-gray-700">Tidak hadir 2 hari tanpa
                                            keterangan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center flex-shrink-0 font-semibold text-yellow-600">
                                        RW</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Rina Wijaya</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Kontrak
                                                Exp</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Finance</p>
                                        <p class="text-xs font-medium text-gray-700">Kontrak berakhir 15 Februari 2026
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 font-semibold text-blue-600">
                                        GM</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Gusril Maulana</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-blue-100 text-blue-800">Cuti
                                                Panjang</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Operations</p>
                                        <p class="text-xs font-medium text-gray-700">Cuti 10-20 Januari 2026</p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center flex-shrink-0 font-semibold text-yellow-600">
                                        HK</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Hendra Kusuma</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Kontrak
                                                Exp</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Marketing</p>
                                        <p class="text-xs font-medium text-gray-700">Kontrak berakhir 28 Februari 2026
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 text-center">
                            <a href="{{ route('admin.karyawan') }}"
                                class="text-sm font-semibold text-blue-600 hover:text-blue-700">Kelola Karyawan →</a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Activities -->
                <div
                    class="lg:col-span-2 bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div
                        class="px-6 py-4 border-b border-gray-100/50 bg-gradient-to-r from-pink-50/30 via-purple-50/30 to-orange-50/20">
                        <div class="flex items-center justify-between">
                            <h3 class="text-base font-semibold text-gray-800">Aktivitas Terbaru</h3>
                            <span class="text-xs font-medium text-gray-500 bg-white/60 px-2 py-1 rounded-full">5
                                aktivitas</span>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-100/50">
                        @if (Auth::user()->role === 'direktur')
                            <!-- Direktur Activities - Approval & Request Focus -->
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-100 to-green-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Pengajuan lembur Rina
                                            Wijaya
                                            disetujui</p>
                                        <p class="text-xs text-gray-500 mb-2">4 jam lembur - 7 Jan 2026</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            1 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-yellow-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-100 to-yellow-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Pengajuan cuti Ahmad Rizki
                                            menunggu persetujuan</p>
                                        <p class="text-xs text-gray-500 mb-2">Cuti tahunan 3 hari - mulai 10 Jan 2026
                                        </p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            2 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-red-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Pengajuan cuti ditolak -
                                            Bentrok
                                            shift</p>
                                        <p class="text-xs text-gray-500 mb-2">Budi Santoso - 5 Jan 2026</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            3 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-purple-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Laporan kehadiran Desember
                                            tersedia</p>
                                        <p class="text-xs text-gray-500 mb-2">Tingkat kehadiran: 94.2% dari 156
                                            karyawan</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Kemarin
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-blue-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Surat Keterangan Kerja
                                            diterbitkan
                                        </p>
                                        <p class="text-xs text-gray-500 mb-2">3 surat untuk keperluan karyawan</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            2 hari lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @elseif(Auth::user()->role === 'admin_hrd')
                            <!-- Admin HRD Activities -->
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-100 to-green-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Surat Keterangan Kerja
                                            diterbitkan
                                        </p>
                                        <p class="text-xs text-gray-500 mb-2">Ahmad Rizki - Keperluan Bank</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            30 menit lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-blue-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Karyawan baru ditambahkan
                                        </p>
                                        <p class="text-xs text-gray-500 mb-2">Rina Wijaya - IT & Teknologi</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            2 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-yellow-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-100 to-yellow-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Pengajuan surat masuk</p>
                                        <p class="text-xs text-gray-500 mb-2">Budi Santoso - Surat Referensi</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            3 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-purple-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Data karyawan diperbarui
                                        </p>
                                        <p class="text-xs text-gray-500 mb-2">Dani Hermawan - Perubahan jabatan</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Kemarin
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-red-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Kontrak hampir berakhir
                                        </p>
                                        <p class="text-xs text-gray-500 mb-2">2 karyawan - Perlu diperpanjang</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            2 hari lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Karyawan Activities - Soft Modern Design -->
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-pink-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-pink-100 to-pink-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Cuti Anda disetujui</p>
                                        <p class="text-xs text-gray-500 mb-2">Cuti tahunan 3 hari - Mulai 10 Jan 2026
                                        </p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            2 hari lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-yellow-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-100 to-orange-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Lembur menunggu
                                            persetujuan</p>
                                        <p class="text-xs text-gray-500 mb-2">Lembur 5 jam - 7 Jan 2026</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            1 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-purple-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Surat sudah terbit</p>
                                        <p class="text-xs text-gray-500 mb-2">Surat Keterangan Kerja - Siap diunduh
                                        </p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            1 hari lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-orange-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-100 to-yellow-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Cuti ditolak</p>
                                        <p class="text-xs text-gray-500 mb-2">Cuti sakit 1 hari - 5 Jan 2026</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            3 hari lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-purple-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Slip gaji tersedia</p>
                                        <p class="text-xs text-gray-500 mb-2">Slip gaji Desember - Siap diunduh</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            5 hari lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions & Info -->
                @if (Auth::user()->role !== 'karyawan')
                    <div class="space-y-6">
                        <!-- Quick Actions -->
                        <div
                            class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 overflow-hidden">
                            <div
                                class="px-5 py-4 border-b border-gray-100/50 bg-gradient-to-r from-purple-50/30 to-pink-50/30">
                                <h3 class="text-sm font-semibold text-gray-800">Aksi Cepat</h3>
                            </div>
                            <div class="divide-y divide-gray-100/50">
                                <!-- Quick Actions - Direktur -->
                                @if (Auth::user()->role === 'direktur')
                                    <a href="{{ route('direktur.persetujuan-cuti-lembur') }}"
                                        class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-gray-700" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">Review Pengajuan</p>
                                                <p class="text-xs text-gray-600">13 pengajuan menunggu</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>

                                    <a href="{{ route('direktur.laporan') }}"
                                        class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-gray-700" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zm10-3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1v-3a1 1 0 00-1-1h-3z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">Laporan Bulanan</p>
                                                <p class="text-xs text-gray-600">SDM, kehadiran & pengajuan</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>

                                    <a href="{{ route('direktur.ringkasan-karyawan') }}"
                                        class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-gray-700" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">Ringkasan Karyawan</p>
                                                <p class="text-xs text-gray-600">Data 156 karyawan</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                @elseif(Auth::user()->role === 'admin_hrd')
                                    <!-- Quick Actions - Admin HRD -->
                                    <a href="{{ route('admin.karyawan') }}"
                                        class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-blue-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">Kelola Karyawan</p>
                                                <p class="text-xs text-gray-600">156 karyawan aktif</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>

                                    <a href="{{ route('admin.surat') }}"
                                        class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-purple-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">Kelola Surat</p>
                                                <p class="text-xs text-gray-600">5 surat menunggu</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>

                                    <a href="{{ route('admin.template') }}"
                                        class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-green-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                                    <path fill-rule="evenodd"
                                                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">Template Surat</p>
                                                <p class="text-xs text-gray-600">Kelola template</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Upcoming Events -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-5">
                            <h3 class="text-sm font-semibold text-gray-800 mb-4">Agenda Mendatang</h3>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="w-2 h-2 rounded-full bg-purple-400 mt-1.5"></div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Meeting Tim</p>
                                        <p class="text-xs text-gray-500">Hari ini, 14:00 WIB</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="w-2 h-2 rounded-full bg-yellow-400 mt-1.5"></div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Evaluasi Kinerja</p>
                                        <p class="text-xs text-gray-500">Besok, 09:00 WIB</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="w-2 h-2 rounded-full bg-pink-400 mt-1.5"></div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Pelatihan</p>
                                        <p class="text-xs text-gray-500">10 Jan 2026, 10:00 WIB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>

    <!-- Mobile Sidebar Toggle (for responsive) -->
    <div class="lg:hidden fixed bottom-6 right-6 z-50">
        <button
            class="w-14 h-14 bg-indigo-600 rounded-full shadow-lg flex items-center justify-center text-white hover:bg-indigo-700 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
</x-app-layout>
