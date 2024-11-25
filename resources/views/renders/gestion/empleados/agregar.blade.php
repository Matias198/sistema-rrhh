@extends('adminlte::page')

@section('title', 'EMPLEADOS')

@section('content_header')
    <h1>CONTRATAR UN NUEVO EMPLEADO</h1>
@stop

@section('content')
    @livewire('Gestion.Empleados.Agregar')
@stop

@section('footer')
    <div class="py-16 text-center text-sm text-black dark:text-white/70">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop
