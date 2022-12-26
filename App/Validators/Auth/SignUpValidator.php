<?php

namespace App\Validators\Auth;

class SignUpValidator extends Base
{
    protected array $rules = [
        'email' => '/^[a-zA-Z0-9.!#$%&\'*+\/\?^_`{|}~-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i',
        'password' => '/[a-zA-Z0-9.!#$%&\'*+\/\?^_`{|}~-]{8,}/',
        'user_nm' => '/[a-zA-Z0-9_]{3,}/',
        'name' => '/[a-zA-Z]{2,}/',
        'surname' => '/[a-zA-Z]{2,}/'
    ];

    protected array $errors = [
        'email_error' => 'Email is incorrect',
        'password_error' => 'Password is incorrect',
        'user_nm_error' => 'Username should contain only "a-z A-Z 0-9 _" and length should be more than 3 symbols',
        'name_error' => 'Name should contain only "a-z A-Z" characters and length should be more than 2 symbols',
        'surname_error' => 'Surname should contain only "a-z A-Z" characters and length should be more than 2 symbols'
    ];
}
