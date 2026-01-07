<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        return match($user->role) {
            'admin_hrd' => view('dashboard'),
            'direktur' => view('dashboard'),
            'karyawan' => view('dashboard'),
            default => view('dashboard'),
        };
    })->name('dashboard');
});
