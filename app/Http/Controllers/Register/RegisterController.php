<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function register(): object
    {
        return view('register.pages.userRegister')->with([
            'name' => 'alex'
        ]);
    }
}
