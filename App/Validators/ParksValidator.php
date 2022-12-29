<?php

namespace App\Validators;

use App\Models\Park;
use App\Validators\Base\BaseValidator;

class ParksValidator extends BaseValidator
{
    protected array $rules = [
        'serial_number' => '/^[a-zA-Z0-9_]{3,16}$/',
        'address' => '/[a-zA-Z0-9_]{3,}/'
    ];

    protected array $errors = [
        'serial_number' => 'Serial number should contain only "a-z A-Z 0-9 _" and length should be more than 3 symbols and less than 16',
        'address' => 'Address should contain only "a-z A-Z 0-9 _" and length should be more than 3 symbols',
    ];
}
