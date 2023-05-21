<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    //protegemos la url
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        //Modificamos el request
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' .auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
            'email' => ['unique:users,email,'. auth()->user()->email, 'max:60'],
        ]);


        if($request->imagen)
        {
            $imagen = $request->file('imagen');

            //Creamos un id unico que pondremos de nombre con la extension de la imagen
            $nombreImagen = Str::uuid() . "." . $imagen -> extension();
     
            //creamos la imagen para guardarla en el servidor
            $imagenServidor = Image::make($imagen);
     
            //Ledamos el formato a la imagen de anchio y alto
            $imagenServidor -> fit(1000, 1000);
     
     
            //Vamos a guradar la imagen en el servidor
            $imagenPath = public_path('perfiles') . "/" . $nombreImagen;
     
            $imagenServidor -> save($imagenPath);
        }

            //Guardar los cambios del perfil
            $usuario = User::find(auth()->user()->id);
            $usuario->username = $request->username;
            $usuario->email = $request->email ?? auth()->user()->email;
            $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

        if($request->password || $request->oldpassword ) {
            $this->validate($request, [
                'oldpassword' => 'required|min:6',
                'password' => 'required||confirmed|min:6'
            ]);
 
            if (Hash::check($request->oldpassword, auth()->user()->password)) {
                $usuario->password = Hash::make($request->password) ?? auth()->user()->password;
               
            } else {
                return back()->with('mensaje', 'La Contraseña Actual no Coincide');
            }
        }

            $usuario->save();

        //redireccionamos al usuairo
        return redirect()->route('posts.index', $usuario->username);
        
    }
}
