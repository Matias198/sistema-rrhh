@extends('adminlte::page')

@section('title', 'BIENVENIDO')

@section('content_header')
    <h1>DASHBOARD</h1>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4 class="card-title">Calendario de eventos</h4>
        </div>
        <div class="card-body p-0">
            <div id="calendar"></div>
        </div>
    </div>
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
    @vite('resources/js/home.js')
@stop
