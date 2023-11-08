<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Torneo sapo - Coopserp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  </head>
  <body>
@auth

    <div class="card text-center">
        <div class="card-header">
            
          <ul class="nav nav-pills card-header-pills">
           
            
            <li class="nav-item">
                <a class="nav-link" href="/" style="color: green;">Registro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="\admin" style="color: green;">Torneos</a>
            </li>
            <li class="nav-item success" id="go-back">
                <a class="nav-link active" href="" style="background-color: #198754;">Equipos</a>

            </li>         
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color: green;">Opciones</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/participantes">Solicitudes</a></li>
                    <li><a class="dropdown-item" href="/aceptados">Participantes</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
              </li>
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="btn btn-link text-success">Cerrar sesión</button>
                </form> 
          </ul>
          
        </div>
 
            @extends('layouts.app')

            @section('content')
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
                                        <th>Estado</th>
                                        <th>Equipo</th>
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
                                            
                                            <td>{{$participante->estado}}</td>
                                            <td>{{$participante->fk_id_equipo}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                
                                    <table id="participantes" class="table table-striped" style="width:100%">
                                       <!-- ... (tu tabla) ... -->
                                    </table>
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                 </form>
                                 
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



