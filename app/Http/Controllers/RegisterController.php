<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //

   public  function index()
    {
        return view('auth.register');
    }

    public function store( Request $request)
    {
        //Modificar el request para que nos muestre la validación
        $request -> request->add(['username'=> Str::slug( $request->username),]);

        //validación de los datos que se insertan en los input
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
        ]);

        //Creando registro con eloquent para insertalo en la DB
        User::create([
            'name' => $request->name ,
            'username' => $request->username ,
            'email' => $request->email,
            //Con la clese Hash encriptamos los password 
            'password' => Hash::make( $request->password)
        ]);

        //Autenticar a el usuario que se acaba de registrar usando el helpers auth()

        //Forma 1
        /*  auth()->attempt([
                'email' => $request->email,
                'password' => $request->password
            ]); 
        */

        //Segunda forma de autenticar el usurio
        auth()->attempt($request->only('email', 'password'));



        //Una vez registrado el usuario lo redireccionamos a su muro con el helpers redirect() 
        //y le pasamos la ruta del controlador
        return redirect()->route('posts.index');
        
    }
}


