<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AccountController extends ApiController
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create($data);

        return $this->success('Akun berhasil dibuat.', $this->token($user), 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
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
