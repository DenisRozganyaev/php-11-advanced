<?php

namespace App\Validators\Auth;

class LoginValidator extends Base
{
    protected array $rules = [
        'email' => '/^[a-zA-Z0-9.!#$%&\'*+\/\?^_`{|}~-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i',
        'password' => '/[a-zA-Z0-9.!#$%&\'*+\/\?^_`{|}~-]{8,}/'
    ];

    protected array $errors = [
        'email' => 'Email or password is incorrect',
        'password' => 'Email or password is incorrect',
    ];

    public function verifyPassword(string $formPass, $userPass): bool
    {
        return password_verify($formPass, $userPass);
    }
}
