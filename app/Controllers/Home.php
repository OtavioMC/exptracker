<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        throw new Exception( "kk");
        return view('welcome_message');
    }
}
