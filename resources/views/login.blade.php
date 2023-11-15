<!doctype html>
<html lang="en" style="height: 100%;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Torneo sapo - Coopserp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-image: url('{{ asset('img/sapi.png') }}'); /* Poner la imagen de fondo */
            background-size: cover; /* Asegurar que la imagen de fondo cubra toda la página */
            background-position: center;
            overflow: hidden;
        }
        .login-container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background-color: rgba(255, 255, 255, 0.8); /* Efecto de opacidad al 60% */
            padding: 2rem;
            border-radius: 10px;
            width: 30%; /* Ajusta el ancho como prefieras */
            max-width: 500px;
        }
        /* Ajustes adicionales para que se vea bien en dispositivos móviles */
        @media (max-width: 768px) {
            .login-box {
                width: 90%;
            }
        }
    </style>
</head>
<body>

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="login-container">
    <div class="login-box">

        <h2 style="color: #198754;" class="text-center">Inicio de sesión</h2>
        <form action="{{route('iniciar')}}" method="POST">
            @csrf
            <div class="form-group mb-3" >
                <label for="nombre" class="fw-bold">Nombre</label>
                <input name="loginname" type="name" class="form-control" id="examplename" placeholder="Nombre">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="fw-bold">Contraseña</label>
                <input name="loginpassword" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <br>
            <div class="text-center">
                <button type="submit" class="btn btn-success fw-bold fs-5 p-2">Iniciar sesion</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
