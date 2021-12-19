<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\Responses\Response;

class LoginController extends AControllerRedirect
{

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function register()
    {
        return $this->html();
    }

    public function login()
    {
        return $this->html();
    }
}