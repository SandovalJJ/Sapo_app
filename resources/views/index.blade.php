<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Torneo sapo - Coopserp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
@auth
<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link active" href="" style="background-color: #198754;">Registro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin" style="color: green;">Torneos</a>
            </li>
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="btn btn-link text-success">Cerrar sesión</button>
            </form>
        </ul>
    </div>
    <div class="card-body">
        <div class="row">

            
            <!-- Columna para la tabla de registro (60%) -->
            <div class="col-md-4 offset-md-4">
                <div style="border: 1px solid rgb(21, 198, 18), 0.663); padding: 10px; margin: 10px auto; text-align: center;" class="m-3">
                    <h2 style="color: #198754;">REGISTRO EN EL TORNEO</h2>
                    <!-- Contenido de tu formulario -->
                    <form action="/create-participante" method="post">
                        @csrf
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="mb-3">
                            <label for="cedula" class="form-label">Cédula</label>
                            <input type="number" name="cedula" class="form-control" id="cedula" placeholder="Cédula" style="border: 1px solid green;">
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" style="border: 1px solid green;">
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido" style="border: 1px solid green;">
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="number" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" style="border: 1px solid green;">
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo" style="border: 1px solid green;">
                        </div>
                        <div class="mb-3">
                            <label for="agencia" class="form-label">Agencia</label>
                            <input type="text" name="agencia" class="form-control" id="agencia" placeholder="Agencia" style="border: 1px solid green;">
                        </div>
                        <button type="submit" class="btn btn-success m-3 text-center">Registrar</button>
                    </form>
                </div>
            </div>
       
            
        </div>
    </div>
    <a href="https://www.coopserp.com/" class="btn btn-success">Coopserp</a>
</div>
      @else
{{-- DIV de navegacion --}}
<div class="card text-center">
    <div class="card-header">
      <ul class="nav nav-pills card-header-pills">
        <li class="nav-item">
            <a class="nav-link active" href="" style="background-color: #198754;">Registro</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/login" style="color: green;">Iniciar Sesión</a>
        </li>
      </ul>
    </div>
    <div class="col-md-4 offset-md-4">
        <div style="border: 1px solid rgb(21, 198, 18), 0.663); padding: 10px; margin: 10px auto; text-align: center;" class="m-3">
            <h2 style="color: #198754;">REGISTRO EN EL TORNEO</h2>
            <!-- Contenido de tu formulario -->
            <form action="/create-participante" method="post">
                @csrf
                <div class="mb-3">
                    <label for="cedula" class="form-label">Cédula</label>
                    <input type="number" name="cedula" class="form-control" id="cedula" placeholder="Cédula" style="border: 1px solid green;">
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" style="border: 1px solid green;">
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido" style="border: 1px solid green;">
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="number" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" style="border: 1px solid green;">
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo" style="border: 1px solid green;">
                </div>
                <div class="mb-3">
                    <label for="agencia" class="form-label">Agencia</label>
                    <input type="text" name="agencia" class="form-control" id="agencia" placeholder="Agencia" style="border: 1px solid green;">
                </div>
                <button type="submit" class="btn btn-success m-3 text-center">Regitrar</button>
            </form>
        </div>
    </div>
    
      
      <a href="https://www.coopserp.com/" class="btn btn-success">Coopserp</a>
    </div>
  </div>
  @endauth

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>