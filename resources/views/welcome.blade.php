<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ve mi Tienda</title>
<link rel="stylesheet" href="{{ asset('adminlte3/css/login.css') }}">
</head>

<body>
    <div class="wrapper fadeInDown">
        <div>
            <h2 class="active"> Acceso Administrativo </h2>
            <div class="fadeIn first">
                <img src="{{ asset('img/logo.png') }}" id="icon" alt="User Icon" />
            </div>
            <form method="POST" action="{{ url('loguear') }}">
                <input type="text" class="fadeIn second" name="login" placeholder="email">
                <input type="text" class="fadeIn third" name="login" placeholder="contraseña">
                <input type="submit" class="fadeIn fourth" value="Ingresar">
            </form>
        </div>
    </div>
</body>

</html>
