@extends('layouts.app')

@section('title','Register' )


@section('content')

<div class="block mx-auto my-12 p-8 bg-white w-2/3 border border-gray-200 
rounded-lg shadow-lg">

  <h1 class="text-3xl text-center font-bold">Registro</h1>

  <form id="form_register" method="POST" action="">
    @csrf
    <div class="space-y-12">

      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Información Personal</h2>
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-3">
            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Nombre</label>
            <div class="mt-2">
              <input type="text" name="name" id="name" autocomplete="name" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              @error('name')
              <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
              @enderror
            </div>
          </div>


          <div class="sm:col-span-3">
            <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Correo</label>
            <div class="mt-2">
              <input type="text" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              @error('email')
              <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="sm:col-span-3">
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Contraseña</label>
            <div class="mt-2">
              <input id="password" name="password" type="password" autocomplete="password" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              @error('password')
              <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="sm:col-span-3">
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Confirmar Contraseña</label>
            <div class="mt-2">
              <input id="password_confirmation" name="password_confirmation" type="password" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div class="form-group mt-3">
            {!! NoCaptcha::renderJs('es', false, 'onLoadCallback') !!}
            {!! NoCaptcha::display() !!}
            @if($errors->has('g-recaptcha-response'))
            <p class="border border-red-500 rounded-md bg-red-100 w-full
        text-red-600 p-2 my-2">
              * {{ $errors->first('g-recaptcha-response') }}
            </p>
            @endif
          </div>


        </div>
      </div>

      <div class="mt-6 flex items-center justify-end gap-x-6">
        <a href="{{ route('login.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</a>
        <button type="submit" class="rounded-md bg-gray-800 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Aceptar</button>
      </div>
  </form>

  @endsection

  <script>
    var onLoadCallback = function() {
      alert('recaptcha is ready')
    };
  </script>