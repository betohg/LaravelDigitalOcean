@extends('layouts.app')

@section('title','Register' )


@section('content')

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nombre Producto
                </th>
                <th scope="col" class="px-6 py-3">
                    Descripción
                </th>
                <th scope="col" class="px-6 py-3">
                    Precio
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $producto->name }}
                </th>
                <td class="px-6 py-4">
                    {{ $producto->description }}
                </td>
                <td class="px-6 py-4">
                    {{ $producto->price }}
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('productos.edit', $producto->id) }}" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-1 me-0 mb-0 dark:focus:ring-yellow-900">Editar</a>
                    <a href="{{ route('productos.destroy', $producto->id) }}" onclick="event.preventDefault(); if(confirm('¿Estás seguro de que quieres eliminar este producto?')) { fetch('{{ route('productos.destroy', $producto->id) }}', { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }}).then(response => { if(response.ok) location.reload(); }).catch(error => console.error('Error al eliminar el producto:', error)); }" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-1 me-0 mb-0 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Eliminar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection