@extends('adminlte::page')

@section('title', 'GERENTES')

@section('content_header')
    <h1>LISTA DE GERENTES GENERALES</h1>
@stop

@section('content')
    @livewire('PersonasGerentesTable')
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
