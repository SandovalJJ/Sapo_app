<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Torneo sapo - Coopserp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/056e693a0d.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">


  </head>
  <body> <nav class="navbar navbar-expand-lg p-3" style="background-color: #005e56">

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
            @auth
            <div class="card-body">
                <div style="border: 1px solid green; padding: 10px; margin: 10px auto; text-align: center;" class="m-3">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <form action="{{ route('guardar-puntos') }}" method="POST">
                                @csrf
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
                                            <td>
                                                <input type="text" class="form-control" value="{{ $participante->puntos }}" name="puntos[{{ $participante->cedula }}]">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                    <button type="submit" class="btn btn-success"><Strong>Guardar</Strong></button>
                                 </form> 
                                 <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Eliminar</h1>                                                   
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('remover.participante') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="equipo_id" value="{{ $id_equipo }}">
                                                <select class="form-select" name="participante_id" aria-label="Select example">
                                                    @foreach($participantes as $integrante)
                                                        <option value="{{ $integrante->cedula }}">{{ $integrante->nombre }} {{ $integrante->apellido }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-danger mt-3">Eliminar participante</button>
                                            </form>                                                        
                                        </div>
                                            <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Opción agregar participante</button>                                                   
                                            </div>                                                  
                                            </div>                                                
                                        </div>
                                        <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Agregar</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('asignar.participante') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="equipo_id" value="{{ $id_equipo }}">
                                                        <select class="form-select" name="participante_id" aria-label="Select example">
                                                            @foreach($participantesSinEquipo as $participante)
                                                                <option value="{{ $participante->cedula }}">{{ $participante->nombre }} {{ $participante->apellido }}</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="submit" class="btn btn-success mt-3">Agregar participante</button>
                                                    </form>                                                                                                          
                                                </div>
                                                <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Volver a la opción eliminar</button>
                                            </div>
                                            </div>
                                        </div>
                                  <button class="btn btn-success mt-3 " data-bs-target="#exampleModalToggle" data-bs-toggle="modal"><i class="bi bi-pencil-square"></i><strong>Editar</strong></button>
                                  @endauth
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
        @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>       
  </body>
</html>



