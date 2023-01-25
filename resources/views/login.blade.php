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
        <div id="formContent">
            <h2 class="active">Acceso Administrativo</h2>
            <div class="fadeIn first">
                <img src="{{ asset('img/logo.png') }}" id="icon" alt="User Icon" />
            </div>
            <form method="POST" action="{{ route('loguear') }}">
                @csrf
                <input type="text" class="fadeIn second" name="email" placeholder="Email">
                <br><small style="color:red">@error('email') {{ $message }} @enderror</small>

                <input type="text" class="fadeIn third" name="password" placeholder="Contraseña">
                <br><small style="color:red">@error('password') {{ $message }} @enderror</small>
                <br><br>
                <label for="">
                    <input type="checkbox" class="fadeIn third" name="remember">Recuerda mi Sesión
                </label>
                <br><br>
                <input type="submit" class="fadeIn fourth" value="Ingresar">
            </form>
        </div>
    </div>
</body>

</html>
