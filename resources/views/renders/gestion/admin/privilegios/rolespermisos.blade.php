@extends('adminlte::page')

@section('title', 'ROLES Y PERMISOS')

@section('content_header')
    <h1>GESTIÓN DE ROLES Y PERMISOS</h1>
@stop

@section('content') 
    @livewire('gestion.admin.privilegios.rolespermisos')
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
