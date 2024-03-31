@extends('layouts.app')

@section('title', 'Application')

@section('content')

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Verifica con tu aplicación</h2>
    </div>
    @if(session('error'))
    <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium">Error: </span> {{ session('error') }}
        </div>
    </div>
    @endif
    <p class="mt-10 text-center text-sm text-gray-500">
        1.- Ingresa el siguiente codigo en tu aplicacion para validar el ingreso correctamente
    </p>
    <p class="mt-1 text-center text-sm text-gray-500">
        2.- Da Clic en "Continuar" una vez que la aplicacion haya validado el codigo
    </p>
    <p class="mt-1 text-center text-sm text-gray-900">
        <strong>{{ $codigoAleatorio }}</strong>
    </p>

    <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" method="POST" action="{{ route('app.store') }}">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}"> <!-- Incluye el correo electrónico en el formulario -->
            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-gray-800 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Aceptar</button>
            </div>
        </form>
    </div>
</div>

@endsection