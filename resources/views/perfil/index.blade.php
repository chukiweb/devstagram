@extends('layouts.app')

@section('titulo')

    Editar Perfil: {{ auth()->user()->username}}

@endsection

@section('contenido')

    <div class="md:flex md:justify-center ">
        <div class="md:w-1/2 bg-white shadow p-10">
            <form class="mt-10 md:mt-0" action="{{ route('perfil.store')}}" enctype="multipart/form-data" method="POST">

                @csrf
                {{-- Div del nombre de usuario --}}
                <div class="mb-5">
                    <label for="username" id="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input id="username" name="username" type="text" placeholder="Tu nombre de Usuario" class="border p-3 w-full rounded-lg @error('username')
                        border-red-500
                    @enderror"
                    value="{{ auth()->user()->username}}"/>
                    <!--Validación de los input -->
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p> 
                    @enderror
                </div> 

                {{-- Div de la imagen de usuario --}}
                <div class="mb-5">
                    <label for="imagen" id="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen de Perfil</label>
                    <input id="imagen" name="imagen" type="file" class="border p-3 w-full rounded-lg"
                    value=""
                    accept=".jpg, .jpeg, .png"
                    />
                </div> 

                {{-- Div para cambiar el email --}}
                <div class="mb-5">
                    <label for="email" id="email" class="mb-2 block uppercase text-gray-500 font-bold">Nuevo Email</label>
                    <input id="email" name="email" type="email" placeholder="Tu email" class="border p-3 w-full rounded-lg @error('email')
                        border-red-500
                    @enderror"
                    value="{{ auth()->user()->email}}"/>
                    <!--Validación de los input -->
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p> 
                    @enderror
                </div> 

                {{-- Div para cambiar el Password --}}
                <div class="mb-5">
                    <label for="oldpassword" id="oldpassword" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña Antigua</label>
                    <input id="oldpassword" name="oldpassword" type="password" placeholder="Tu password antiguo" class="border p-3 w-full rounded-lg @error('oldpassword')
                        border-red-500
                    @enderror"
                    value=""/>
                    <!--Validación de los input -->
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p> 
                    @enderror
                </div> 

                 {{-- Div para nuevo el Password --}}
                 <div class="mb-5">
                    <label for="password" id="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña Nueva</label>
                    <input id="password" name="password" type="password" placeholder="Tu password nuevo" class="border p-3 w-full rounded-lg @error('password')
                        border-red-500
                    @enderror"
                    value=""/>
                    <!--Validación de los input -->
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p> 
                    @enderror
                </div> 

                {{-- Div para repetir el nuevo el Password --}}
                <div class="mb-5">
                    <label for="password_confirmation" id="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repite Contraseña Nueva</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Repite tu nueva contraseña" class="border p-3 w-full rounded-lg @error('password_confimation')
                        border-red-500
                    @enderror"
                    value=""/>
                    <!--Validación de los input -->
                    @error('password_confimation')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p> 
                    @enderror
                </div> 



                {{-- Input de guardar cambios --}}
                <input type="submit" value="Guardar Cambios" class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg mt-5">

            </form>
        </div>
    </div>
    
@endsection