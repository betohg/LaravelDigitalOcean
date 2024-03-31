@extends('layouts.app')

@section('title', 'Verification')

@section('content')

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Verifica tu codigo</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" method="POST" action="{{ route('auth.storeve') }}">
      @csrf
      <div>
        <input type="hidden" name="email" value="{{ $email }}">
        <label for="telephone" class="block text-sm font-medium leading-6 text-gray-900">Codigo</label>
        <div class="mt-2">
          <input id="verification_code" name="verification_code" type="tel" required class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
        @error('verification_code')
        <p class="border border-red-500 rounded-md bg-red-100 w-full
          text-red-600 p-2 my-2">* {{ $message }}</p>
        @enderror
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-gray-800 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Aceptar</button>
      </div>
    </form>
  </div>
</div>

@endsection