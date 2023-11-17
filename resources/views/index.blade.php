<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Torneo sapo - Coopserp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('{{ asset('img/sapi.png') }}'); no-repeat center center fixed;
            background-size: cover;
        }
        .overlay {
            background-color: rgba(255, 255, 255, 0.8); /* Blanco con opacidad */
            border-radius: 15px; /* Bordes redondeados */
            padding: 20px;
        }
        .form-container {
            backdrop-filter: blur(5px); /* Efecto de desenfoque para fondo */
            background-color: rgba(233, 227, 227, 0.2); /* Fondo negro con opacidad */
            border-radius: 15px; /* Bordes redondeados */
            padding: 20px;
        }
        .form-label {
            color: #fff; /* Color de texto blanco para las etiquetas */
        }
    </style>
</head>
<body>
@auth
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="overlay">
        <div class="form-container text-center">
            
            <h2 style="color: #198754;">REGISTRO TORNEO</h2>
            <!-- Contenido de tu formulario -->
            <form action="/create-participante" method="post">
                @csrf
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                        <div class="mb-3">
                            <label for="cedula" class="form-label text-dark fw-bold">Cédula</label>
                            <input type="number" name="cedula" class="form-control" id="cedula" placeholder="Cédula" style="border: 1px solid green;">
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label text-dark fw-bold">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" style="border: 1px solid green;">
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label text-dark fw-bold">Apellido</label>
                            <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido" style="border: 1px solid green;">
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label text-dark fw-bold">Teléfono</label>
                            <input type="number" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" style="border: 1px solid green;">
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label text-dark fw-bold">Correo</label>
                            <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo" style="border: 1px solid green;">
                        </div>
                        <div class="mb-3">
                            <label for="agencia" class="form-label text-dark fw-bold">Agencia</label>
                            <input type="text" name="agencia" class="form-control" id="agencia" placeholder="Agencia" style="border: 1px solid green;">
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Registrar</button>
                    </form>
                    <div class="card-header">
                        <ul class="nav nav-pills justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link active mt-3 text-center" href="/admin" style="background-color: #198754;">ADMIN</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

</div>
      @else
      <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="overlay">
            <div class="form-container text-center">
                
                <h2 style="color: #198754;">REGISTRO TORNEO</h2>
                <!-- Contenido de tu formulario -->
                <form action="/create-participante" method="post">
                    @csrf
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                            <div class="mb-3">
                                <label for="cedula" class="form-label text-dark fw-bold">Cédula</label>
                                <input type="number" name="cedula" class="form-control" id="cedula" placeholder="Cédula" style="border: 1px solid green;">
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label text-dark fw-bold">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" style="border: 1px solid green;">
                            </div>
                            <div class="mb-3">
                                <label for="apellido" class="form-label text-dark fw-bold">Apellido</label>
                                <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido" style="border: 1px solid green;">
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label text-dark fw-bold">Teléfono</label>
                                <input type="number" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" style="border: 1px solid green;">
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label text-dark fw-bold">Correo</label>
                                <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo" style="border: 1px solid green;">
                            </div>
                            <div class="mb-3">
                                <label for="agencia" class="form-label text-dark fw-bold">Agencia</label>
                                <input type="text" name="agencia" class="form-control" id="agencia" placeholder="Agencia" style="border: 1px solid green;">
                            </div>
                            <button type="submit" class="btn btn-success mt-3">Registrar</button>
                        </form>
                        <div class="card-header">
                            <ul class="nav nav-pills justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link active mt-3 text-center" href="/login" style="background-color: #198754;">Iniciar sesión</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
  @endauth

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>