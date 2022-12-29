<?php

namespace App\Controllers;

use App\Helpers\Session;
use App\Services\AuthService;
use App\Validators\Auth\LoginValidator;
use App\Validators\Auth\SignUpValidator;
use Core\Controller;
use Core\View;
use App\Services\Users\CreateService;

class AuthController extends Controller
{
    const AUTH_ACTIONS = ['logout'];

    public function login()
    {
        Session::destroy();
        View::render('auth/login');
    }

    public function register()
    {
        View::render('auth/register');
    }

    public function signup()
    {
        $fields = filter_input_array(INPUT_POST, $_POST);
        $validator = new SignUpValidator();

        if ($validator->validate($fields) && !$validator->checkEmailOnExists($fields['email']) && CreateService::call($fields)) {
            redirect('login');
        }

        View::render('auth/register', $this->getErrors($fields, $validator, ['email_error' => 'Email already exists']));
    }

    public function verify()
    {
        $fields = filter_input_array(INPUT_POST, $_POST);
        $validator = new LoginValidator();

        if (AuthService::call($fields, $validator, true)) {
            redirect('admin/dashboard');
        }

        View::render('auth/login', $this->getErrors($fields, $validator, ['email_error' => 'Email already exists']));
    }

    public function logout()
    {
        Session::destroy();
        redirect('login');
    }

    public function before(string $action): bool
    {
        if (Session::check() && !in_array($action, self::AUTH_ACTIONS)) {
            redirect();
        }

        return parent::before($action);
    }
}
