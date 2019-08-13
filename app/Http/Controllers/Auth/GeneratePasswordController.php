<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class GeneratePasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Generator
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for generating a password
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public static function generate()
    {
        $randomPassword = str_random(4);

        //send email
        return $randomPassword;
    }
}
