<?php

namespace App\Controllers;

use App\Models\Car;
use Core\Controller;

class ParksController extends Controller
{
    public function show(int $id)
    {
//        dd(Car::select(['model', 'price'])->get());
//        Car::create([
//           'park_id' => 1,
//           'model' => 'Suzuki',
//           'year' => 2019,
//           'price' => 20.50
//        ]);
//        dd(Car::all());
        dd(Car::select(['model', 'price'])->where('price', '>', 15)->get());
    }
}