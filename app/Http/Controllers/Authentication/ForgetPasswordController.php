<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;

class ForgetPasswordController extends Controller
{
    public function view()
    {
        return view('Authentication.forget-password');
    }
}
