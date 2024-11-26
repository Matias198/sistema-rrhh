@extends('adminlte::page')

@section('title', 'EMPLEADOS')

@section('content_header')
    <h1>PERFIL DEL EMPLEADO</h1>
    <a class="mr-2 my-2" href="{{ route('gestion-empleados-listar') }}">
        <i class="fas fa-arrow-left"></i>
        VOLVER A LA TABLA
    </a>
@stop

@section('content')
    @livewire('Gestion.Empleados.Ver', ['id_persona' => $id_persona])
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
