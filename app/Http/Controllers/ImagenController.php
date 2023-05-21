<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {
       $imagen = $request->file('file');

       //Creamos un id unico que pondremos de nombre con la extension de la imagen
       $nombreImagen = Str::uuid() . "." . $imagen -> extension();

       //creamos la imagen para guardarla en el servidor
       $imagenServidor = Image::make($imagen);

       //Ledamos el formato a la imagen de anchio y alto
       $imagenServidor -> fit(1000, 1000);


       //Vamos a guradar la imagen en el servidor
       $imagenPath = public_path('uploads') . "/" . $nombreImagen;

       $imagenServidor -> save($imagenPath);

      return response()->json(['imagen' => $nombreImagen ]);
      
    }
}
