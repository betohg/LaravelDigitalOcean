<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>@yield('title') - Laravel Seguridad</title>

  <!-- Tailwind CSS Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css">
  <link rel="stylesheet" href="styles.css">

  <!-- Fontawesome Link -->
  <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">

</head>

<body>
  <nav class="flex items-center justify-between px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-700 text-white shadow-lg">
    <div class="flex items-center">
      <h1 class="text-xl font-bold">Aplicacion Laravel</h1>
    </div>
    <ul class="flex items-center space-x-4">
      @if(auth()->check())
      <li>
        <p class="text-lg">Bienvenido <b>{{ auth()->user()->name }}</b></p>
      </li>
      <li>
        <a href="{{ route('login.destroy') }}" class="font-semibold px-4 py-2 rounded-md bg-red-600 hover:bg-red-700">Cerrar Sesión</a>
      </li>
      @else
      <li>
        <a href="{{ route('login.index') }}" class="font-semibold px-4 py-2 rounded-md bg-white text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300">Iniciar Sesión</a>
      </li>
      <li>
        <a href="{{ route('register.index') }}" class="font-semibold px-4 py-2 rounded-md bg-white text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300">Registrar</a>
      </li>
      @endif
    </ul>
  </nav>
  @yield('content')

</body>

</html>