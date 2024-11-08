@extends('adminlte::page')

@section('title', 'PUESTOS DE TRABAJO')

@section('content_header')
    <div id="agregar_puesto_header">
        <h1>AGREGAR NUEVO PUESTO DE TRABAJO</h1>
    </div>
@stop

@section('content')
    <div class="mx-2 alert alert-primary alert-dismissible fade show" role="alert">
        <strong>Ayuda:</strong> Para agregar o editar las capacidades y tareas para un
        puesto de trabajo, puedes hacerlo desde las siguientes herramientas.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="col">
        <div class="card card-primary collapsed-card">
            <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                <h3 class="card-title">HERRAMIENTAS DE TAREAS</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: none;">
                @livewire('Gestion.Admin.PuestoTrabajo.Tareas')
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <div class="col">
        <div class="card card-primary collapsed-card">
            <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                <h3 class="card-title">HERRAMIENTAS DE CAPACIDADES</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: none;">
                @livewire('Gestion.Admin.PuestoTrabajo.Capacidades')
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">DESCRIPCION Y ANALISIS DE PUESTO DE TRABAJO</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool"><i class="fas fa-smile"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @livewire('Gestion.Admin.PuestoTrabajo.Agregar')
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
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

<?php
$id_puesto_trabajo = session('id_puesto_trabajo');
?>

@section('js')
@stop
