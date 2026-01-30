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
            // departemen wajib hanya jika role = karyawan
            'departemen_id' => ['required_if:role,karyawan'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ];

        // Jika role admin_hrd atau direktur, wajib verification_code
        if (isset($input['role']) && in_array($input['role'], ['admin_hrd', 'direktur'])) {
            $validationRules['verification_code'] = ['required', 'string'];
        }

        $messages = [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.string' => 'Nama tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Role wajib dipilih.',
            'departemen_id.required_if' => 'Divisi wajib dipilih untuk role karyawan.',
            'departemen_id.integer' => 'Divisi tidak valid.',
            'departemen_id.exists' => 'Divisi yang dipilih tidak ditemukan.',
            'verification_code.required' => 'Kode verifikasi wajib diisi.',
        ];

        $validator = Validator::make($input, $validationRules, $messages);

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

        // Jika role = karyawan, terima baik id numeric maupun kode departemen.
        if (isset($input['role']) && $input['role'] === 'karyawan') {
            $deptInput = $input['departemen_id'] ?? null;
            if ($deptInput) {
                // non-numeric (kode) -> cari atau buat departemen
                if (!is_numeric($deptInput)) {
                    $kode = strtolower(trim($deptInput));
                    $dept = \App\Models\Departemen::firstOrCreate(
                        ['kode' => $kode],
                        ['nama' => ucfirst($kode), 'deskripsi' => 'Divisi ' . ucfirst($kode)]
                    );
                    $input['departemen_id'] = $dept->id;
                } else {
                    $input['departemen_id'] = intval($deptInput);
                }
            } else {
                $input['departemen_id'] = null;
            }
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => $input['role'],
            'departemen_id' => $input['departemen_id'] ?? null,
        ]);
    }
}
