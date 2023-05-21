<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        //Validamos que no esta vacio y no es mayor de 255 caracteres
        $this->validate($request, [
            'comentario'=>'required|max:255'
        ]);
        //Almacenamos el resultado
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);

        //Imprimir un menasaje 
        return back()->with('Comentario realizado correctamente');
    }
}
