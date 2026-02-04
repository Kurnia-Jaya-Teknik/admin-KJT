<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Laporan Lembur') }}</h2>
    </x-slot>

    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-white min-h-full">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-3">Laporan Lembur</h3>
                    <p class="text-sm text-gray-600 mb-4">Halaman ringkasan & export untuk laporan lembur. Jika Anda
                        ingin saya implementasikan preview tabel dan export, saya siap menambahkan.</p>

                    <div class="flex gap-3">
                        <a href="{{ route('direktur.laporan.lembur') }}"
                            class="px-3 py-2 rounded-lg border border-purple-400 text-purple-400 font-semibold hover:bg-purple-50 transition-colors">Lihat</a>
                        <a href="{{ route('direktur.laporan.lembur') }}?export=csv"
                            class="px-3 py-2 rounded-lg border border-emerald-400 text-emerald-400 font-semibold hover:bg-emerald-50 transition-colors">Export
                            Excel</a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
                    <div class="text-sm text-gray-600">Belum ada ringkasan yang diimplementasikan untuk Laporan Lembur.
                        Saya bisa membuatkan preview dan export jika Anda ingin.</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
