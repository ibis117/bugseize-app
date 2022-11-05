<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class LoginUser
{
    use AsAction;

    public function rules(): array
    {
        return [
            'username' => 'required|alpha_dash',
            'password' => 'required'
        ];
    }

    public function handle($username, $password, $isTokenAuth = false): bool | string
    {
        if ($isTokenAuth) {
            return $this->tokenAuth($username, $password);
        }

        return \Auth::attempt([
            'email' => $username,
            'password' => $password,
            fn ($q) => $q->orWhere('username', $username)
        ]);

    }

    private function tokenAuth($username, $password) {
        $user = User::where('username', $username)->orWhere('email', $username)->first();

        if (! $user || ! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $user->createToken($username)->plainTextToken;
    }


    public function asController(ActionRequest $request)
    {
        $credentials = $request->only('username', 'password');
        $token = $this->handle(...$credentials);
        if ($token) {
            return response([
                'token' => $token
            ], 200);
        }
    }
}
