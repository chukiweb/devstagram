@extends('layouts.app')


@section('titulo')
    Crear una nueva publicación
@endsection

<!--Directiva para cargar hojas de estilos -->
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush


@section('contenido')

    <div class="md:flex md:items-center">

        <div class="md:w-1/2 px-10">
            <form action="{{route('imagenes.store')}}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rouded flex flex-col justify-center items-center">@csrf </form>
        </div>

        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action= "{{ route('posts.store') }}" method="POST" novalidate>
                {{-- Los token CSRF permiten prevenir un frecuente agujero de seguridad de las aplicaciones web llamado 
               "Cross Site Request Forgery". En español sería algo como "falsificación de petición en sitios cruzados" o 
               simplemente falsificación de solicitud entre sitios.

               Básicamente es un ataque de seguridad que permite modificar el estado del servidor haciéndose pasar por un usuarioo determinado. 
               El sitio web confia en el el usuario pero la petición no es real y está siendo falsificada por el atacante. 
               Como el sitio web confía en el usuario, realiza una operación solicitada y la procesa como si se tratase del usuario real. --}}
               @csrf  
               <!--Input para el nombre completo del usuario-->
               <div class="mb-5">
                   <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                   <input id="titulo" name="titulo" type="text" placeholder="Titulo de la publicación" class="border p-3 w-full rounded-lg @error('titulo')
                       border-red-500
                   @enderror"
                   value="{{ old('titulo')}}"/>
                   <!--Validación de los input -->
                   @error('titulo')
                       <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p> 
                   @enderror
               </div> 

               <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripción</label>
                    <textarea id="descripcion" name="descripcion" placeholder="Descripción de la publicación" class="border p-3 w-full rounded-lg 
                    @error('descripcion')
                        border-red-500
                    @enderror"> {{ old('descripcion')}} </textarea>
                    <!--Validación de los input -->
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p> 
                    @enderror
                </div> 

                {{-- Campo que almacena  la imagen subido por el usuario--}}
                <div class="mb-5">
                    <input  name="imagen" type="hidden" value="{{ old('imagen')}}"/>
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p> 
                    @enderror
                </div>

                <input type="submit" value="Publicar" class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg mt-5">
               
            </form>
        </div>

    </div>
    
@endsection