@extends('adminlte::page')

@section('title', 'EMPLEADOS')

@section('content_header')
@stop

@section('content')
    <div class="body_custom">
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="container_custom">
                <img class="icon" src="{{asset('/img/empleado-del-mes.webp')}}" alt="">
                <h1 class="h1_custom">Alta de empleado exitosa</h1>
                <p class="p_custom">El empleado ha sido registrado correctamente en el sistema.</p>
                <a href="{{ route('gestion-empleados-listar') }}" class="btn_custom">Ver empleados</a>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <div class="py-16 text-center text-sm text-black dark:text-white/70">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </div>
@stop

@section('css')
    <style>
        .body_custom {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .container_custom {
            text-align: center;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .icon {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }

        .h1_custom {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .p_custom {
            font-size: 16px;
            color: #666;
        }

        .btn_custom {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn_custom:hover {
            color: #fff;
            background-color: #0056b3;
        }
    </style>
@stop

@section('js')
@stop
