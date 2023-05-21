@extends('layouts.app')

@section('titulo')

    Regístrate en DevStagram

@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:items-center md:gap-10">
        <div class="md:w-6/12 p-5">
            <img src="{{asset('img/registrar.jpg')}}" alt="Imagen de registro de usuario">
        </div>
        <div class="md:w-4/12 bg-white p-5 rounded-lg shadow">
            <form action= "{{route('register')}}" method="POST" novalidate>
                 {{-- Los token CSRF permiten prevenir un frecuente agujero de seguridad de las aplicaciones web llamado 
                "Cross Site Request Forgery". En español sería algo como "falsificación de petición en sitios cruzados" o 
                simplemente falsificación de solicitud entre sitios.

                Básicamente es un ataque de seguridad que permite modificar el estado del servidor haciéndose pasar por un usuarioo determinado. 
                El sitio web confia en el el usuario pero la petición no es real y está siendo falsificada por el atacante. 
                Como el sitio web confía en el usuario, realiza una operación solicitada y la procesa como si se tratase del usuario real. --}}
                @csrf  
                <!--Input para el nombre completo del usuario-->
                <div class="mb-5">
                    <label for="name" id="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input id="name" name="name" type="text" placeholder="Tu nombre" class="border p-3 w-full rounded-lg @error('name')
                        border-red-500
                    @enderror"
                    value="{{ old('name')}}"/>
                    <!--Validación de los input -->
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p> 
                    @enderror
                </div> 
                <!-- Input para el nombre de usuario-->
                <div class="mb-5">
                    <label for="username" id="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input id="username" name="username" type="text" placeholder="Tu nombre de Usuario" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{ old('username')}}"/>
                     <!--Validación de los input -->
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p> 
                    @enderror
                </div> 
                <!--Input para el correo electronico -->
                <div class="mb-5">
                    <label for="email" id="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input id="email" name="email" type="text" placeholder="Tu Email de registro" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email')}}"/>
                     <!--Validación de los input -->
                     @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p> 
                     @enderror
                </div> 
                <!--Input para el password -->
                <div class="mb-5">
                    <label for="password" id="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input id="password" name="password" type="password" placeholder="Tu password de registro" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" />

                     <!--Validación de los input -->
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p> 
                    @enderror
                </div> 
                <!--Input para comprobar password -->
                <div class="mb-5">
                    <label for="password_confirmation" id="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold"> Repetir Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Tu password de registro" class="border p-3 w-full rounded-lg"/>
                </div> 

                <input type="submit" value="Crear Cuenta" class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg mt-5">
    

            </form>
        </div>

    </div>
@endsection