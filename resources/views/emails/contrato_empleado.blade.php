<!DOCTYPE html>
<html>

<head>
    <title>Contrato de Trabajo</title>
</head>

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

    a {
        color: #333;
        font-size: 16px;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    .container {
        margin: 0 auto;
        max-width: 600px;
        padding: 20px;
    }

    .logo {
        display: block;
        margin: 0 auto;
        max-width: 100%;
    }

    .footer {
        background-color: #333;
        color: #fff;
        font-size: 14px;
        padding: 10px;
        text-align: center;
    }

    .footer a {
        color: #fff;
        font-weight: bold;
    }

    .footer a:hover {
        text-decoration: underline;
    }

    .footer p {
        margin: 0;
    }

    .footer p:last-child {
        margin-bottom: 0;
    }

    .footer .container {
        max-width: 100%;
    }

    .footer .logo {
        max-width: 100px;
    }

    .footer .social {
        margin-top: 10px;
    }

    .footer .social a {
        margin-right: 10px;
    }

    .footer .social a:last-child {
        margin-right: 0;
    }

    .footer .social img {
        max-width: 20px;
    }

    .footer .social img:hover {
        opacity: 0.8;
    }

    .footer .social p {
        display: inline;
        margin: 0;
    }

    .footer .social p:last-child {
        margin-right: 10px;
    }

    .footer .social p:last-child::after {
        content: '';
    } 
</style>

<body>
    <!-- Email para el empleado recien contratado -->
    <h1>Contrato de Trabajo</h1>
    <p>Estimado/a {{ $persona->nombre }} {{ $persona->apellido }},</p>
    <p>¡Bienvenido/a a la empresa!</p>
    <p>Te informamos que has sido contratado/a para desempeñar el puesto de {{ $empleado->puesto()->titulo_puesto }}.</p>
    <p>El contrato de trabajo se ha firmado el día {{ $empleado->fecha_ingreso }} y tendrá una duración de {{ Carbon::parse($empleado->contrato()->fecha_vencimiento)->diffInMonths($empleado->fecha_salida) }} meses.</p>
    <p>El horario de trabajo será de {{ $empleado->contrato()->hora_entrada }} a {{ $empleado->contrato()->hora_salida }}.</p>
    <p>El salario mensual será de {{ $empleado->contrato()->sueldo }} pesos Argentinos (ARS).</p>
    <p>Esperamos que tu estancia en la empresa sea satisfactoria y que puedas desarrollarte profesionalmente.</p>
    <p>¡Bienvenido/a y mucha suerte!</p>
    <p>Atentamente,</p>
    <p>El equipo de {{ $empresa->nombre }}</p>
    <p>Este es un mensaje automático, por favor no responda a este correo.</p>
    <p>Si tienes alguna duda, por favor contacta con nosotros en el teléfono {{ $empresa->telefono }} o en la dirección de correo electrónico {{ $empresa->email }}.</p>
    <p>Gracias.</p>
    <p>© {{ $empresa->nombre }}</p>
</body>

<script>
    // Código JavaScript para abrir los enlaces en una nueva pestaña
    const links = document.querySelectorAll('a');
    links.forEach(link => link.setAttribute('target', '_blank'));

</script>

</html>
