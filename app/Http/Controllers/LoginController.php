<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

       

        if( !auth()->attempt($request->only('email', 'password'),$request->remember))
        {
            /**
             * Con el with conseguimos llenar este tipo de mensajes para poder utilizarlos en las vistas
             * de mi app se crean en los controladores y se consumen en las vistas
             * El bach lo utilizamos para retornar a la url en donde se dio el error y asi no tenemos que estar redireccionando todo el rato
             */
            return back()->with('mensaje', 'Credenciales incorrectas');
        }

        return redirect()->route('posts.index',['user'=> auth()->user()->username]);
    }

}
