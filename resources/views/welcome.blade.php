@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')
@inject('preloaderHelper', 'JeroenNoten\LaravelAdminLte\Helpers\PreloaderHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
    <style>
        html {
            min-height: 100%;
            position: relative;
        }

        footer { 

            position: absolute;
            bottom: 0;
            width: 100%;
            height: 55px; 
        }

        body { 
            margin: 0;
            margin-bottom: 50px;
        }

        .back {
            background-image: url('./img/recursoshumanos-bg.webp');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            /* Aplicar desenfoque */
            filter: blur(2px);
            width: 100%;
            height: 100vh;
            position: fixed;
            z-index: -1;

            /* Aplicar sombra */
            -webkit-box-shadow: inset 0px 0px 300px -45px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: inset 0px 0px 300px -45px rgba(0, 0, 0, 0.75);
            box-shadow: inset 0px 0px 300px -45px rgba(0, 0, 0, 0.75);
        }

        .titulo {
            color: #FFFFFF;
            text-shadow: 2px 2px 0px #333333, 5px 4px 0px rgba(0, 0, 0, 0.15);
        }

        .subtitulo {
            color: #FFFFFF;
            text-shadow: -1px -1px 1px rgba(255, 255, 255, .1), 1px 1px 1px rgba(0, 0, 0, 1);
        }
    </style>
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="back"></div>
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary p-3">
            <a class="navbar-brand" href="/home">SISTEMA RRHH</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <div class="mr-auto mt-2 mt-lg-0">
                    <!-- Vacio para acomodar elementos en la derecha-->
                </div>
                <ul class="navbar-nav">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if (!Auth::user()->hasRole('SYSADMIN')) 
                                {{ Auth::user()->persona()->first()->nombre . ' ' . Auth::user()->persona()->first()->apellido }}
                                @else
                                SYSTEM ADMIN
                                @endif
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <!-- Volver al home -->
                                <a class="dropdown-item" href="/home">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>


        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center mb-4 titulo">Bienvenido al Sistema de Gestión de Recursos Humanos</h1>
                    <p class="lead text-center subtitulo">Aquí podrás gestionar toda la información relacionada con el
                        personal de
                        la
                        empresa.</p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card h-100 ">
                        <div class="card-body bg-primary">
                            <h5 class="card-title"><strong>Gestión de Empleados</strong></h5>
                            <p class="card-text">Administra la información de los empleados, incluyendo datos personales
                                y
                                laborales.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body bg-primary">
                            <h5 class="card-title"><strong>Liquidación de Sueldos</strong></h5>
                            <p class="card-text">Gestiona los salarios, bonificaciones y deducciones de los empleados.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body bg-primary">
                            <h5 class="card-title"><strong>Gestión de Licencias</strong></h5>
                            <p class="card-text">Administra las licencias de los empleados.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">¡Importante!</h4>
                        <p>Recuerda mantener actualizada la información de los empleados para garantizar una gestión
                            eficiente de los recursos humanos.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © Sistema de Gestión de RRHH - 2024
        </div>
    </footer>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
