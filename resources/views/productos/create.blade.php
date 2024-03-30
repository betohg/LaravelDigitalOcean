@extends('layouts.app')

@section('title','Register' )


@section('content')

<div class="block mx-auto my-12 p-8 bg-white w-2/3 border border-gray-200 
rounded-lg shadow-lg">

    <h1 class="text-3xl text-center font-bold">Registrar Producto</h1>

    <form id="form_register" method="POST" action="">
        @csrf
        <div class="space-y-12">

            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-5">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Nombre</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" autocomplete="name" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('name')
                            <p class="border border-red-500 rounded-md bg-red-100 w-full
                                text-red-600 p-2 my-2">* {{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="sm:col-span-1">
                        <label for="precio" class="block text-sm font-medium leading-6 text-gray-900">Precio</label>
                        <div class="mt-2">
                            <div class="flex">
                                <input type="text" name="precio" id="precio" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('precio')
                            <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Descripción</label>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="password" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('password')
                            <p class="border border-red-500 rounded-md bg-red-100 w-full
                                text-red-600 p-2 my-2">* {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Imagen</label>
                        <div class="mt-2">
                            <input id="password_confirmation" name="password_confirmation" type="password" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>


                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="{{ route('login.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</a>
                <button type="submit" class="rounded-md bg-gray-800 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Aceptar</button>
            </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var inputPrecio = document.getElementById('precio');

            inputPrecio.addEventListener('input', function() {
                // Eliminar cualquier caracter que no sea un dígito numérico o un punto decimal
                var cleanedValue = inputPrecio.value.replace(/[^0-9.]/g, '');

                // Si hay más de un punto decimal, eliminar todos excepto el primero
                var decimalCount = (cleanedValue.match(/\./g) || []).length;
                if (decimalCount > 1) {
                    cleanedValue = cleanedValue.replace(/\.(?=.*\.)/g, '');
                }

                // Agregar el prefijo "$" al campo de entrada
                inputPrecio.value = '$' + cleanedValue;
            });
        });
    </script>

    <!-- <form class="mt-4" id="form_register" method="POST" action="">
    @csrf

    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full
    text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="Nombre"
    id="name" name="name">

    @error('name')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror

    <input type="email" class="border border-gray-200 rounded-md bg-gray-200 w-full
    text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="Correo"
    id="email" name="email">

    @error('email')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror

    <input type="password" class="border border-gray-200 rounded-md bg-gray-200 w-full
    text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="Password"
    id="password" name="password">

    @error('password')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror

    <input type="password" class="border border-gray-200 rounded-md bg-gray-200 
    w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" 
    placeholder="Password confirmation" id="password_confirmation" 
    name="password_confirmation">
    <div class="form-group mt-3">
      {!! NoCaptcha::renderJs('es', false, 'onLoadCallback') !!}
      {!! NoCaptcha::display() !!}
    </div>
    @if($errors->has('g-recaptcha-response'))
    <p class="border border-red-500 rounded-md bg-red-100 w-full
        text-red-600 p-2 my-2">
        * {{ $errors->first('g-recaptcha-response') }}
    </p>
    @endif
    <button type="submit" class="rounded-md bg-blue-500 w-full text-lg
    text-white font-semibold p-2 my-3 hover:bg-blue-600">Enviar</button>
  </form> -->

    @endsection

    <script>
        var onLoadCallback = function() {
            alert('recaptcha is ready')
        };
    </script>