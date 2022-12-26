<?php

namespace App\Controllers\Admin;

use App\Helpers\Session;

class BaseController extends \Core\Controller
{
    public function before(string $action): bool
    {
        if (!Session::isUser()) {
            redirect();
        }

        return true;
    }
}
