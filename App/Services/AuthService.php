<?php

namespace App\Services;

use App\Helpers\Session;
use App\Models\User;
use App\Validators\Auth\LoginValidator;

class AuthService
{
    public static function call(array $fields, LoginValidator &$validator, $isUser = false): bool
    {
        if ($validator->validate($fields) && $user = $validator->checkEmailOnExists($fields['email'])) {
            if ($validator->verifyPassword($fields['password'], $user?->password)) {
                Session::setUserData($user->id, ['is_user' => $isUser]);
                return true;
            }
        }

        return false;
    }
}
