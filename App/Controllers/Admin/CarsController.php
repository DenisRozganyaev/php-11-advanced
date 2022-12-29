<?php

namespace App\Controllers\Admin;

use App\Models\Car;
use App\Models\Park;
use App\Services\ParksService;
use App\Validators\ParksValidator;
use Core\View;

class CarsController extends BaseController
{
    public function index()
    {
        $parks = Car::all();
        View::render('admin/parks/index', compact('parks'));
    }

    public function create()
    {
        View::render('admin/parks/create');
    }

    public function store()
    {
        $fields = filter_input_array(INPUT_POST, $_POST);
        $validator = new ParksValidator();

        if (ParksService::create($fields, $validator)) {
            redirect('admin/parks');
        }

        View::render('admin/parks/create', $this->getErrors($fields, $validator));
    }

    public function edit(int $id)
    {
        $park = Park::find($id);
        // Park::update($id, $fields);
        // $park->update($fields);
        dd($park);
    }

    public function update(int $id)
    {

    }

    public function destroy(int $id)
    {

    }
}
