<?php

namespace App\Services;

use App\Models\Park;
use App\Validators\ParksValidator;

class ParksService
{
    public static function create(array $fields, ParksValidator $validator): bool
    {
        if (!$validator->validate($fields) || Park::findBy('serial_number', $fields['serial_number'])) {
            return false;
        }

        return (bool) Park::create($fields);
    }

    public static function update(int $id, array $fields, ParksValidator $validator): bool
    {
        $result = true;
        $park = Park::find($id);

        if (!$validator->validate($fields)) {
            $result = false;
        }

        if ($fields['serial_number'] !== $park->serial_number && Park::findBy('serial_number', $fields['serial_number'])) {
            $validator->setError('serial_number', 'Duplicated serial number');
            $result = false;
        }

        return $result ? $park->update($fields) : $result;
    }
}
