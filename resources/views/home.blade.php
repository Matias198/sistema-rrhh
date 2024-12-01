@extends('adminlte::page')

@section('title', 'BIENVENIDO')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>DASHBOARD</h1>
        <a type="button" class="btn btn-primary" onclick="openSwallModal()">
            {{-- i de email --}}
            <i class="fas fa-envelope"></i>
            Agregar Evento
        </a>
    </div>
@stop

@section('content')
    @livewire('gestion.calendario.calendario')
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
