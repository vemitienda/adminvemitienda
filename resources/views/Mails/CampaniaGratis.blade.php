<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Ve mi Tienda</title>
    <style>
        /* Estilos generales */
        body {
            font-family: sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
        }

        /* Estilos específicos */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f6f6f6;
            border-radius: 10px;
        }

        h1 {
            font-size: 28px;
            margin-top: 0;
            margin-bottom: 20px;
            color: #333;
        }

        p {
            margin-top: 0;
            margin-bottom: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <center>
            <img src="{{ asset('img/logo.png') }}" alt="" width="100px">
            <h1>¡Ahora nuestra App es gratis!</h1>
        </center>
        @if (@$name)
            <p>¡Hola {{ $name }}!</p>
        @endif
        <p>
            ¡Descubre la nueva versión de nuestra increíble aplicación móvil! Ahora, completamente gratis para ti.
            ¿Recuerdas cuando era de pago? ¡Eso es cosa del pasado! Hemos decidido hacerla accesible para todos, porque
            queremos que disfrutes al máximo de todas sus funcionalidades sin limitaciones.
        </p>
        <p>
            ¡Te esperamos con los brazos abiertos en nuestra aplicación móvil!
        </p>
        @if (@$company->name)
            <p>Queremos ayudarte a que {{ $company->name }} sea un negocio próspero</p>
        @endif
        <p>¿Tienes problemas para colocar tus productos o tienes algunas dudas?</p>
        <p>Si necesitas atención personalizada, nos puedes escribir a</p>
        <ul>
            <li>Correo: <a href="#">info@vemitienda.online</a></li>
            <li>Whatsapp: <a href="#">0424.849.68.99</a></li>
        </ul>
        <p>¡Gracias de nuevo por unirte a nuestra comunidad de Ve mi Tienda!</p>
        <p>Atentamente,</p>
        <p>El equipo de Ve mi Tienda</p>
        <hr>
    </div>
</body>

</html>
