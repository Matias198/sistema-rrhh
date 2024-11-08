@extends('adminlte::page')

@section('title', 'CALENDARIO')

@section('content')
    @livewire('Gestion.Eventos.Agregar')
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>     
@stop

@section('footer')
    <div class="py-16 text-center text-sm text-black dark:text-white/70">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </div>
@stop


@section('js')
@stop

