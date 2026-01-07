<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $validationRules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'role' => ['required', 'in:admin_hrd,direktur,karyawan'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ];

        // Jika role admin_hrd atau direktur, wajib verification_code
        if (isset($input['role']) && in_array($input['role'], ['admin_hrd', 'direktur'])) {
            $validationRules['verification_code'] = ['required', 'string'];
        }

        $validator = Validator::make($input, $validationRules);

        // Custom validation untuk verification_code
        $validator->after(function ($validator) use ($input) {
            if (isset($input['role'])) {
                if ($input['role'] === 'admin_hrd') {
                    if (!isset($input['verification_code']) || $input['verification_code'] !== env('ADMIN_HRD_CODE')) {
                        $validator->errors()->add('verification_code', 'Kode verifikasi Admin HRD salah.');
                    }
                } elseif ($input['role'] === 'direktur') {
                    if (!isset($input['verification_code']) || $input['verification_code'] !== env('DIREKTUR_CODE')) {
                        $validator->errors()->add('verification_code', 'Kode verifikasi Direktur salah.');
                    }
                }
            }
        });

        $validator->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => $input['role'],
        ]);
    }
}
