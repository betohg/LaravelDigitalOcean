@extends('layouts.app')

@section('title','Home' )
  

@section('content')

  
@if(Auth::user()->type == 1)
    {{ __("Administrador") }}
    
@else
    {{ __("No - Administrador") }}
    
@endif
@endsection