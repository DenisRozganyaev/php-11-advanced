<?php

namespace App\Controllers\Admin;

use App\Models\Park;
use App\Services\ParksService;
use App\Validators\ParksValidator;
use Core\View;

class ParksController extends BaseController
{
    public function index()
    {
        $parks = Park::all();
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
        View::render('admin/parks/edit', compact('park'));
    }

    public function update(int $id)
    {
        $fields = filter_input_array(INPUT_POST, $_POST);
        $validator = new ParksValidator();

        if (ParksService::update($id, $fields, $validator)) {
            redirect('admin/parks');
        }

        $params = array_merge(
            $this->getErrors($fields, $validator),
            ['park' => (object)$fields]
        );

        View::render('admin/parks/edit', $params);
    }

    public function destroy(int $id)
    {
        Park::find($id)->destroy();
        redirect('admin/parks');
    }
}
