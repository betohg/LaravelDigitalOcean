@extends('layouts.app')

@section('title','EditProduct' )


@section('content')

<div class="block mx-auto my-12 p-8 bg-white w-2/3 border border-gray-200 
rounded-lg shadow-lg">

    @if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">Edicion Exitosa!</span> {{ session('success') }}
    </div>
    @endif

    <h1 class="text-3xl text-center font-bold">Registrar Producto</h1>

    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="space-y-12">

            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-5">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nombre</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" autocomplete="name" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $producto->name }}">
                            @error('name')
                            <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="sm:col-span-1">
                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Precio</label>
                        <div class="mt-2">
                            <div class="flex">
                                <input type="text" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $producto->price }}">
                            </div>
                            @error('price')
                            <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Descripción</label>
                        <div class="mt-2">
                            <input id="description" name="description" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $producto->description }}">
                            @error('description')
                            <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Imagen</label>
                        <div class="mt-2">
                            <input id="image" name="image" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $producto->image }}">
                            @error('image')
                            <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="{{ route('home') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</a>
                <button type="submit" class="rounded-md bg-gray-800 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Aceptar</button>
            </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var inputPrecio = document.getElementById('price');

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

    @endsection

    <script>
        var onLoadCallback = function() {
            alert('recaptcha is ready')
        };
    </script>