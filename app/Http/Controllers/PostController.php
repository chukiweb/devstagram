<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Esta función constructora va a verificar que el usuario este 
     * autenticado antes de mostrar cualquier view y asi le daremos mas seguridad 
     * a nuestra aplicación
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }
    //
    public function index(User $user)
    {
        //Creamos la variable post para pasar los datos a la vista
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);


        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    //formulario de entrada de datos
    public function create()
    {
       return view('posts.create');
    }

    //Almacenar en la base de datos
    public function store(Request $request)
    {
        //Validamos los datos
        $this -> validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        //creamos el post y lo insertamos en la base de datos
       /*  Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]); */

        //Otra forma de crear registros en la base de datos
/*         $post = new Post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id; */

        /**
         * Esta es otro manera de guardar los post que crea el usuario autenticado 
         * que creo el post mediante la variable request y la relación que creamos entre
         * post y user
         */
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);
        //redirigimos a el muro del usuario que creo el post
        return redirect()->route('posts.index', auth()->user()->username);
    }

    /**
     * Funcion para mostrar todos los pos del usuario autenticdos
     */
    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    /**
     * Funcion para eliminar post de la red social */ 
    public function destroy(Post $post)
    {
       $this->authorize('delete', $post);
       $post ->delete();

       //Eliminar la imagen
       $imagen_path = public_path('uploads/' . $post->imagen);
       if (File::exists($imagen_path))
       {
        unlink($imagen_path);
       }

       return redirect()->route('posts.index', auth()->user()->username);
    }
}
