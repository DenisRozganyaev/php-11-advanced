<?php

namespace App\Models;

class Car extends \Core\Model
{
    protected static string|null $tableName = 'cars';

    public function getInfo(): string
    {
        // $this->name
        // $this?->name ===== if $this === null ? null : $this->name
        return $this?->model . ' - ' . $this?->price;
    }
}
