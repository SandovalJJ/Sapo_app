<!DOCTYPE html>
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
                    <a class="nav-link active" href="/enfrentamientos" style="background-color: #198754;">Enfrentamientos</a>
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
        </div>
        @extends('layouts.app')
        @section('content')
        @endsection
        <div class="row">
            <form action="{{ route('crear_enfrentamientos', ['id_torneo' => $torneo->id_torneo]) }}" method="GET">
                @csrf
                <button type="submit" class="btn btn-success mb-2 mt-5">Crear Enfrentamientos</button>
            </form>
            <div class="col-md-8 mb-5">

                <div class="card m-5"> 
                    <div class="card-body table-responsive">
                        <h5 class="card-title">ENFRENTAMIENTO ACTUAL</h5>
                        <BR></BR>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="table-dark">ID</th>
                                    <th class="table-dark">Torneo</th>
                                    <th class="table-dark">Equipo Local</th>
                                    <th class="table-dark">Equipo Visitante</th>
                                    <th class="table-dark">Ronda</th>
                                    <th class="table-dark">Resultado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enfrentamientos as $enfrentamiento)
                                    @if ($enfrentamiento->resultado === null)
                                        <tr>
                                            <td>{{ $enfrentamiento->id_enfrentamiento }}</td>

                                            <td>{{ $enfrentamiento->id_equipo_local }}</td>
                                            <td>{{ $enfrentamiento->id_equipo_visitante }}</td>

                                            <td>{{ $enfrentamiento->resultado }}</td>
                                        </tr>
                                        @break 
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>     
              
                </div>
            
                     
            </div>
        </div>      
            <div class="col-md-4 mb-5">
                <div class="card m-5">                     
                    <div class="card-body table-responsive">
                        <h5 class="card-title">ENFRENTAMIENTOS PROXIMOS</h5>
                        <BR>
                        <table class="table table-dark table-striped">
                            <caption>Lista de los proximos equipos por efrentarse.</caption>
                            <thead>
                                <tr>
                                    <th class="table-dark">ID</th>
                                    <th class="table-dark">Torneo</th>
                                    <th class="table-dark">Equipo Local</th>
                                    <th class="table-dark">Equipo Visitante</th>
                                    <th class="table-dark">Ronda</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enfrentamientoss as $enfrentamiento)
                                    @if ($enfrentamiento->resultado === null)
                                        <tr>
                                            <td>{{ $enfrentamiento->id_enfrentamiento }}</td>
                                            <td>{{ $enfrentamiento->fk_id_torneo }}</td>
                                            <td>{{ $enfrentamiento->id_equipo_local }}</td>
                                            <td>{{ $enfrentamiento->id_equipo_visitante }}</td>
                                            <td>{{ $enfrentamiento->ronda }}</td>

                                        </tr>
                                        
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card m-5"> 
                
                    <div class="card-body table-responsive">
                        <h5 class="card-title">Ganadores</h5>
                        <BR></BR>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th class="table-dark">ID</th>
                                    <th class="table-dark">Torneo</th>
                                    <th class="table-dark">Equipo Local</th>
                                    <th class="table-dark">Equipo Visitante</th>
                                    <th class="table-dark">Ronda</th>
                                    <th class="table-dark">Resultado</th>
    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resultados as $resultado)
                                    @if ($resultado->resultado !== null)
                                        <tr>
                                            <td class="table-success">{{ $resultado->id_enfrentamiento }}</td>
                                            <td class="table-success">{{ $resultado->fk_id_torneo }}</td>
                                            <td class="table-success">{{ $resultado->id_equipo_local }}</td>
                                            <td class="table-success">{{ $resultado->id_equipo_visitante }}</td>
                                            <td class="table-success">{{ $resultado->ronda }}</td>
                                            <td class="table-success">{{ $resultado->resultado }}</td>
    
                                        </tr>
                                        
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
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



