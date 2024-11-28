@extends('adminlte::page')

@section('title', 'AUDITORIA')

@section('content_header')
    <h1>AUDITORIA GENERAL DEL SISTEMA</h1>
@stop

@section('content')
    @livewire('AuditsTable')
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('verAuditoria', function(params) {
                console.log(params[0]);
                params = params[0];

                // Generar el contenido dinámico para "Valores anteriores"
                let oldValuesHtml = '';
                for (const [key, value] of Object.entries(params.old_values)) {
                    oldValuesHtml += `<br><strong>${key}:</strong> ${value}`;
                }

                // Generar el contenido dinámico para "Valores nuevos"
                let newValuesHtml = '';
                for (const [key, value] of Object.entries(params.new_values)) {
                    newValuesHtml += `<br><strong>${key}:</strong> ${value}`;
                }

                Sweetalert2.fire({
                    title: 'AUDITORIA',
                    html: `
                    <div class="text-left">
                        <p><strong>ID:</strong> ${params.id}</p>
                        <p><strong>Evento:</strong> ${params.event}</p>
                        <p><strong>Fecha:</strong> ${params.created_at}</p>
                        <p><strong>IP:</strong> ${params.ip_address}</p>
                        <p><strong>URL:</strong> ${params.url}</p>
                        <p><strong>Usuario:</strong> ${params.user_id}</p>
                        <p><strong>Modelo:</strong> ${params.auditable_type}</p>
                        <p><strong>ID Modelo:</strong> ${params.auditable_id}</p>
                        <p><strong>Valores anteriores:</strong>${oldValuesHtml}</p>
                        <p><strong>Valores nuevos:</strong>${newValuesHtml}</p>
                    </div>
                `,
                    showCloseButton: true,
                    showCancelButton: false,
                    showConfirmButton: false,
                    focusConfirm: false,
                    focusCancel: false,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                });
            });
        });
    </script>
@stop
