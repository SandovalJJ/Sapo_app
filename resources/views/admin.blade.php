<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Torneo sapo - Coopserp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
  </head>
  <body>

   
    <div class="card text-center">
        
        <div class="card-header">
            
          <ul class="nav nav-pills card-header-pills">
           
            
            <li class="nav-item">
                <a class="nav-link" href="/" style="color: green;">Registro</a>
            </li>
            @auth
            <li class="nav-item">
                <a class="nav-link active" href="" style="background-color: #198754;">Torneos</a>
            </li>
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color: green;">Opciones</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/participantes">Solicitudes</a></li>
                    <li><a class="dropdown-item" href="/aceptados">Participantes</a></li>
                    <li><a class="dropdown-item" href="/enfrentamientos">Enfrentamientos</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
              </li>
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="btn btn-link text-success">Cerrar sesión</button>
                </form> 
          </ul>
          @endauth
        </div>
        @extends('layouts.app')

        @section('content')
        <div class="card-body">
            <div style="border: 1px solid green; padding: 10px; margin: 10px auto; text-align: center;" class="m-3">
                <div class="card">
                    <div class="card-body">
                                                
                        @auth
                                                            <!-- Botón para abrir el modal -->
                        <button type="button" class="btn btn-success", data-bs-toggle="modal" data-bs-target="#crearTorneoModal">
                            Crear Torneo
                        </button>
                        
                        <!-- Modal para crear torneo -->
                        <div class="modal fade" id="crearTorneoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Crear Torneo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/create-torneo" method="post">
                                    @csrf
                                    <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre del Torneo</label>
                                    <input type="text" name="nombre" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                    <label for="fecha" class="form-label">Fecha del Torneo</label>
                                    <input type="date" name="fecha" class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                                </div>
                                
                            </div>
                            </div>
                        </div>
                        @endauth
                        <div>  </div>
                        <table id="participantes" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($torneos as $torneo)
                                <tr>
                                    <td>{{$torneo->id_torneo}}</td>
                                    <td><a href="{{ route('equipos', ['id_torneo' => $torneo->id_torneo]) }}" class="text-success text-decoration-none estilo-td">{{$torneo->nombre}}</a></td>
                                    <td>{{$torneo->fecha}}</td>
                                </tr>
                            @endforeach
                            
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
        
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
        

     



           

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>



