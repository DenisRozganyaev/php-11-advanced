<?php

namespace Core;

use App\Validators\Base\BaseValidator;

abstract class Controller
{
    public function before(string $action): bool
    {
        return true;
    }

    public function after(string $action) {}

    protected function getErrors(array $fields, BaseValidator $validator, array $errors = []): array
    {
        $data['data'] = $fields;
        $data += array_merge($validator->getErrors(), $errors);

        return $data;
    }
}
