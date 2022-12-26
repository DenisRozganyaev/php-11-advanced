<?php
namespace App\Services\Users;

use App\Models\User;

class CreateService
{
    public static function call(array $fields): bool
    {
        $fields['password'] = password_hash($fields['password'], PASSWORD_BCRYPT);

        return User::create($fields);
    }
}
