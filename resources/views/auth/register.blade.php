<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Akun Baru</h2>
            <p class="text-gray-600 text-sm mt-1">Bergabunglah dengan sistem HRD kami</p>
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" x-data="roleForm()">
            @csrf

            <!-- Nama -->
            <div>
                <x-label for="name" value="{{ __('Nama Lengkap') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
            </div>

            <!-- Role Selection -->
            <div class="mt-4">
                <x-label for="role" value="{{ __('Pilih Role') }}" />
                <select id="role" name="role" required @change="selectedRole = $event.target.value"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3 text-base">
                    <option value="">-- Pilih Role --</option>
                    <option value="karyawan" @selected(old('role') === 'karyawan')>Karyawan</option>
                    <option value="direktur" @selected(old('role') === 'direktur')>Direktur</option>
                    <option value="admin_hrd" @selected(old('role') === 'admin_hrd')>Admin HRD</option>
                </select>
            </div>

            <!-- Verification Code (Conditional) -->
            <div class="mt-4" x-show="selectedRole === 'direktur' || selectedRole === 'admin_hrd'" x-cloak>
                <x-label for="verification_code" value="Kode Verifikasi" />
                <p class="text-xs text-gray-600 mb-2">Masukkan kode verifikasi yang diberikan oleh administrator</p>
                <x-input id="verification_code" class="block mt-1 w-full" type="password" name="verification_code"
                    :value="old('verification_code')" autocomplete="off" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Password Confirmation -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Sudah punya akun?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Daftar') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>

    <script>
        function roleForm() {
            return {
                selectedRole: '{{ old('role') }}'
            }
        }
    </script>
</x-guest-layout>
