<!DOCTYPE html>
<html>
<head>
    <title>Contrato de Trabajo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #333;
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
        }
        p {
            color: #333;
            font-size: 16px;
            margin-top: 10px;
            text-align: justify;
        }
        p:last-child {
            margin-bottom: 20px;
        }
        .container {
            margin: 0 auto;
            max-width: 600px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contrato de Trabajo</h1>
        <p>Estimado/a {{ $empleado->persona->nombre }} {{ $empleado->persona->apellido }},</p>
        <p>¡Bienvenido/a a la empresa!</p>
        <p>Te informamos que has sido contratado/a para desempeñar el puesto de 
           <strong>{{ $empleado->puesto->titulo_puesto }}</strong>.</p>
        <p>El contrato de trabajo se ha firmado el día {{ Carbon\Carbon::parse($empleado->fecha_ingreso)->format('d-m-Y') }} y tendrá una hasta su vencimiento
            el día de la fecha {{ Carbon\Carbon::parse($empleado->contrato->fecha_vencimiento)->format('d-m-Y') }}.</p>
        <p>El horario de trabajo será de {{ $empleado->contrato->hora_entrada }} a 
           {{ $empleado->contrato->hora_salida }}.</p>
        <p>El sueldo basico será de {{ $empleado->contrato->sueldo }} pesos Argentinos (ARS).</p>
        <p>Su usuario es: {{ $empleado->persona->usuario->email }}</p>
        <p>Su contraseña es: {{ $empleado->persona->dni }}</p>
        <p>Esperamos que tu estancia en la empresa sea satisfactoria y que puedas desarrollarte profesionalmente.</p>
        <p>Atentamente,</p>
        <p>El equipo de {{ $empresa->nombre }}</p>
        <p>Este es un mensaje automático, por favor no responda a este correo.</p>
        <p>Si tienes alguna duda, por favor contacta con nosotros en el teléfono {{ $empresa->telefono }} o en la
           dirección de correo electrónico {{ $empresa->email }}.</p>
        <p>Gracias.</p>
        <p>© {{ $empresa->nombre }}</p>
    </div>
</body>
</html>
