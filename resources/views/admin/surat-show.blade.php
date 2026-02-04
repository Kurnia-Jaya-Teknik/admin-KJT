<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Detail Surat') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                <h3 class="text-lg font-medium">{{ $surat->perihal ?? 'Surat' }}</h3>
                <p class="text-sm text-gray-500">Nomor: {{ $surat->nomor_surat }}</p>
                <p class="text-sm text-gray-500">Kepada: {{ $surat->user->name ?? '' }}</p>
                <div class="mt-6 prose">
                    {!! $surat->isi_surat !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
