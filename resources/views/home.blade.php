@extends('layouts.app')

@section('title','Home' )


@section('content')


@if(Auth::user()->role_id == 1)
<p>{{ __("Administrador") }}</p>
<!-- Aquí coloca los botones que deseas mostrar a los administradores -->
<button type="button" class="btn btn-primary">Botón de administrador 1</button>
<button type="button" class="btn btn-secondary">Botón de administrador 2</button>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <img src="img.png" class="card-img-top" alt="sdsd">
            <div class="card-body">
                <h5 class="card-title">Titulo</h5>
                <p class="card-text">Desc</p>
            </div>
        </div>
    </div>
</div>
@else
<p>{{ __("No Administrador") }}</p>

@endif
@endsection