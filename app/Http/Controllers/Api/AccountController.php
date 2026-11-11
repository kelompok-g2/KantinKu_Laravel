<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AccountController extends ApiController
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:72|confirmed',
        ]);

        $user = User::create($data);

        return $this->success('Akun berhasil dibuat.', $this->token($user), 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(['email' => 'required|email|max:255', 'password' => 'required|string|max:72']);
        $guard = Auth::guard('web');
        abort_unless($guard->validate($credentials), 401, 'Email atau kata sandi salah.');

        return $this->success('Berhasil masuk.', $this->token($guard->getLastAttempted()));
    }

    public function me(Request $request)
    {
        return $this->success('Profil pengguna.', $request->user());
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken();
        abort_unless($token instanceof PersonalAccessToken, 401, 'Bearer token diperlukan.');
        $token->delete();

        return $this->success('Berhasil keluar.');
    }

    private function token(User $user): array
    {
        return [
            'user' => $user->refresh(),
            'token' => $user->createToken('kantinku-api', ['*'], now()->addDays(30))->plainTextToken,
            'token_type' => 'Bearer',
        ];
    }
}
