<?php

namespace App\Actions\Auth;

use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class RegisterUser
{
    use AsAction;

    /**
     * @param string $username
     * @param string $password
     * @param string $email
     * @param array $args
     * @return void
     */
    public function handle(string $username, string $password, string $email, array $args)
    {
        return User::create([
            'username' => $username,
            'password' => bcrypt($password),
            'email' => $email,
            ...$args
        ]);
    }
}
