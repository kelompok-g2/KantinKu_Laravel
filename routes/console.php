<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('kantinku:pengelola {email}', function () {
    $user = User::where('email', $this->argument('email'))->first();
    if (! $user) {
        $this->error('Akun tidak ditemukan. Daftar lewat aplikasi terlebih dahulu.');

        return 1;
    }

    $user->is_admin = true;
    $user->save();
    $this->info('Akses pengelola aktif untuk '.$user->email);

    return 0;
})->purpose('Beri akses pengelola kepada akun KantinKu yang sudah terdaftar');
