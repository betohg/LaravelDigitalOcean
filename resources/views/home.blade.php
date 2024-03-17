@extends('layouts.app')

@section('title','Home' )
  

@section('content')

<nav class="flex py-5 bg-indigo-500 text-white">

    
   

</nav>   
@if(Auth::user()->type == 1)
    {{ __("Bienvenido Administrador") }}
    <div style="text-align: center;">
        <img src="https://www.mundodeportivo.com/alfabeta/hero/2023/07/hokages.jpg?width=768&aspect_ratio=16:9&format=nowebp" alt="Admin Image" style="max-width: 100%; height: auto; margin: 0 auto;">
    </div>
@else
    {{ __("Bienvenido Usuario Basic") }}
    <div style="text-align: center;">
        <img src="https://cdn.staticneo.com/w/naruto/Nprofile2.jpg" alt="User Image" style="max-width: 100%; height: auto; margin: 0 auto;">
    </div>
@endif
@endsection