<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Torneo sapo - Coopserp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


    <div class="card text-center">
        <div class="card-header">
          <ul class="nav nav-pills card-header-pills">
           
            <li class="nav-item">
                <a class="nav-link" href="/" style="color: #198754;">Registro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#" style="background-color: green;">Iniciar Sesión</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
            <div style="border: 1px solid green; padding: 10px; margin: 10px auto; text-align: center;" class="m-3">
                <h2 style="color: #198754;">Inicio de sesión</h2>
                <form action="{{route('iniciar')}}" method="POST">
    
                @csrf
                    <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input name="loginname" type="name" class="form-control" id="examplename" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input name="loginpassword" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
            
            <br><br>
            <button type="submit" class="btn btn-success">Iniciar sesion</button>
            </form>
            </div>
        </div>

          <a href="https://www.coopserp.com/" class="btn btn-success">Coopserp</a>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>



