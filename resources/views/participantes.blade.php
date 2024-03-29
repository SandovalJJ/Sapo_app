<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Torneo sapo - Coopserp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/056e693a0d.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">

  </head>
  <body>
@auth

<nav class="navbar navbar-expand-lg p-3" style="background-color: #005e56">

    <a class="navbar-brand">
        <img style="filter: drop-shadow(0 2px 0.8px white);" src="{{ asset('img/LogoCoopserp2014-PNG.png') }}" alt="Descripción de la imagen" width="140" height="60">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="nav nav-pills card-header-pills">
       
        <li class="nav-item">
            <a class="nav-link fw-semibold nav-item-link" href="/" style="color: white; font-size: 25px">Registro</a>
        </li>

        <li class="nav-item">
            <a class="nav-link fw-semibold nav-item-link" href="\admin" style="color: white; font-size: 25px">Torneos</a>
        </li>
        @auth
        <li class="nav-item">
            <a class="nav-link fw-semibold nav-item-link" href="/participantes" style="color: white; font-size: 25px">Solicitudes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link fw-semibold nav-item-link" href="/aceptados" style="color: white; font-size: 25px">Participantes</a>
        </li>
        <li class="nav-item ms-auto">
            
                <form id="logout-form" action="/logout" method="post" style="display: none;">
                    @csrf
                    <button type="submit" id="logout-button"></button>
                </form>

                <a href="#" class="nav-link fw-semibold me-auto nav-item-link" onclick="document.getElementById('logout-button').click();" style="color: white; font-size: 25px;">Cerrar sesión</a>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link fw-semibold nav-item-link " href="/login" style="color: white; font-size: 25px">Iniciar sesión</a>
        </li>
        @endauth
      </ul>
      
</nav>
            @extends('layouts.app')

            @section('content')
            <div class="card-body">
                <div style="border: 1px solid green; padding: 10px; margin: 10px auto; text-align: center;" class="m-3">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="participantes" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Telefono</th>
                                        <th>Correo</th>
                                        <th>Agencia</th>
                                        <th>Puntos</th>
                                        <th>Estado</th>
                                        <th>Acciones</th> <!-- Nueva columna para los botones -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($participantes as $participante)
                                        <tr>
                                            <td>{{$participante->cedula}}</td>
                                            <td>{{$participante->nombre}}</td>
                                            <td>{{$participante->apellido}}</td>
                                            <td>{{$participante->telefono}}</td>
                                            <td>{{$participante->correo}}</td>
                                            <td>{{$participante->agencia}}</td>
                                            <td>{{$participante->puntos}}</td>
                                            <td>{{$participante->estado}}</td>
                                            <td>
                                                <!-- Agregar botones con íconos -->

                                                    <form method="POST" action="{{ route('participante.aceptar', ['id' => $participante->cedula]) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> </button>
                                                    </form>
                                                    <form method="POST" action="{{ route('participante.rechazar', ['id' => $participante->cedula]) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i> </button>
                                                    </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
            @endsection
        
        @section('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        @endsection
        
        @section('js')
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#participantes').DataTable({
                    responsive:true
                });
            });
        </script>
        @endsection
        

     
@else 

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
            <a class="nav-link active" href="#" style="background-color: #198754;">Iniciar Sesión</a>
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

@endauth
           

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>



