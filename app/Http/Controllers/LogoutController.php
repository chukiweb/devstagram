<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //
    public function store()
    {
        //Ceramos la sesión 
        auth()->logout();

        //redirigimos a login
        return redirect()->route('login');
    }
}
