@extends('layouts.app')

@section('titulo')

    Inicia Sesion en DevStagram

@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:items-center md:gap-10">
        <div class="md:w-6/12 p-5">
            <img src="{{asset('img/login.jpg')}}" alt="Imagen login de usuario">
        </div>
        <div class="md:w-4/12 bg-white p-5 rounded-lg shadow">
            <form method="POST"  action="{{route('login')}}" novalidate>
                <!-- Los token CSRF permiten prevenir un frecuente agujero de seguridad de las aplicaciones web llamado 
                "Cross Site Request Forgery". En español sería algo como "falsificación de petición en sitios cruzados" o 
                simplemente falsificación de solicitud entre sitios.

                Básicamente es un ataque de seguridad que permite modificar el estado del servidor haciéndose pasar por un usuarioo determinado. 
                El sitio web confia en el el usuario pero la petición no es real y está siendo falsificada por el atacante. 
                Como el sitio web confía en el usuario, realiza una operación solicitada y la procesa como si se tratase del usuario real. -->
                @csrf  
              
                
                @if(session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ session('mensaje') }}</p> 
                @endif
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
                    <div class="mb-5 mt-5">
                        <input type="checkbox" name="remember"><label class="text-gray-500 text-sm "> Mantener la sesion abierta</label>
                    </div>
                </div>

                <input type="submit" value="Iniciar Sesion" class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg mt-5">
    

            </form>
        </div>

    </div>
@endsection