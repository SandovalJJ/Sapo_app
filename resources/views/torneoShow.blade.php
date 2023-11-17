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
  <body>
@auth
    @if(session('participantesRestantes'))
        <div class="p-3 mb-2 bg-warning-subtle text-emphasis-warning">
            <h4>Participantes que no pudieron ser asignados a un equipo:</h4>
            <ul>
                @foreach(session('participantesRestantes') as $participante)
                    <li><strong>{{ $participante->nombre }} {{ $participante->apellido }}</strong></li>
                @endforeach
            </ul>
        </div>
    @endif



    <div class="card text-center">
        <div class="card-header">
          <ul class="nav nav-pills card-header-pills">
           
            <li class="nav-item">
                <a class="nav-link" href="/" style="color: green;">Registro</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="\admin" style="color: green;">Torneos</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color: green;">Opciones</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/participantes">Solicitudes</a></li>
                    <li><a class="dropdown-item" href="/aceptados">Participantes</a></li>

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
                    
                    <div class="card-body">
                        
                        <p style="font-size: 30px; color: green; font-weight: bold;">Torneo {{ $torneo->nombre }} de sapo - Coopserp</p>
    
                        <div class="container">
                            <div class="d-flex flex-row justify-content-start">

                                <a href="{{ route('enfrentamientos.show', ['id' => request()->route('id_torneo')]) }}" class="btn btn-success me-3 pd-3">Enfrentamientos</a>
                                
                                <a href="{{ route('generar.equipos', ['id_torneo' => request()->route('id_torneo')]) }}" class="btn btn-success me-3 pd-3">Generar equipos</a>
                                
                                <form action="{{ route('crear_enfrentamientos', ['id_torneo' => $torneo->id_torneo]) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Generar enfrentamientos</button>
                                </form>
                                
                            </div>
                            
        <div class="container mt-3">
            <div class="row">
                @foreach ($equipos as $equipo)
                    <!-- Each card takes up 4 columns on large screens, 6 columns on medium screens, and full width on small screens -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <a href="{{ route('participantes', ['id_equipo' => $equipo->id_equipo]) }}" class="text-success text-decoration-none estilo-td mb-3">
                                    Equipo: {{$equipo->id_equipo}}
                                </a>
                                <h6 class="card-subtitle mb-2 text-body-secondary mt-2 fw-bold fs-4">Puntos: {{$equipo->puntos}}</h6>
                                <div style="text-align: center;">
                                    @foreach ($equipo->participantes as $participante)
                                        {{ $participante->nombre }} {{ $participante->apellido }} <br>
                                    @endforeach
                                    <button class="btn btn-success mt-3 " data-bs-target="#exampleModalToggle{{ $equipo->id_equipo }}" data-bs-toggle="modal"><i class="fa-solid fa-crown"></i><strong> CAPITÁN</strong></button>
                                </div>
                                <div class="modal fade" id="exampleModalToggle{{ $equipo->id_equipo }}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalToggleLabel">ASIGNAR CAPITÁN DEL EQUIPO</h1>                                                   
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          
                                        </div>
                                            
                                        <div class="modal-body">
                                            
                                            <form action="  " method="POST">
                                                @csrf



                                                <select class="form-select" name="participante_id" aria-label="Select example">
                                                    @foreach($equipo->participantes as $participante)
                                                        <option value="{{ $participante->cedula }}">{{ $participante->nombre }} {{ $participante->apellido }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-success mt-3 fw-bold">Asignar capitán</button>
                                            </form>                                                        
                                        </div>
                                         </div>                                                  
                                         </div>                                                
                                        </div>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

                        </div>
                        <br>
                           

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
    </div>
  </div>

@endauth
           

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>




<div>



</div>