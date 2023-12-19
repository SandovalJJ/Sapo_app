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
    @if(session('error'))
    <div class="p-3 mb-2 bg-warning-subtle text-emphasis-warning">
        {{ session('error') }}
    </div>
    @endif
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
                    <div class="card-body">
                        <p style="font-size: 30px; color: green; font-weight: bold;">Torneo {{ $torneo->nombre }} de SAPO - Coopserp</p>
                        <div class="container" >
                            @auth
                            <div style="display: flex; justify-content: center; align-items: center;">
                                
                                
                                <a href="{{ route('generar.equipos', ['id_torneo' => request()->route('id_torneo')]) }}" style="background-color: #005e56; color: white" class="btn me-3 pd-3">Generar equipos</a>
                                
                                <form action="{{ route('crear_enfrentamientos', ['id_torneo' => $torneo->id_torneo]) }}" method="GET">
                                    @csrf
                                    <button type="submit" style="background-color: #005e56; color: white" class="btn">Generar enfrentamientos</button>
                                </form>
                                <a href="{{ route('enfrentamientos.show', ['id' => request()->route('id_torneo')]) }}" style="background-color: #005e56; color: white" class="btn me-3 pd-3 ms-3">Enfrentamientos</a>
                            </div>
                            @endauth
        <div class="container mt-3">
            <div class="row">
                @php
                $contador = 1;
                @endphp
                @foreach ($equipos as $equipo)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card" style="width: 100%;">
                            <div style="background-color: #005e56; color: white; border-top-left-radius: .5rem; border-top-right-radius: .5rem; padding: 10px;">
                                @auth
                                <a href="{{ route('participantes', ['id_equipo' => $equipo->id_equipo]) }}" class="text-light text-decoration-none estilo-td mb-3">
                                    Equipo: {{$contador}}
                                </a>
                               @else
                                <p  class="text-light text-decoration-none estilo-tf mb-3">
                                    Equipo: {{$contador}}
                                </p>
                                @endauth
                                <h6 class="card-light mb-2 text-body-light mt-2 fw-bold fs-4">Puntos: {{$equipo->puntos}}</h6>
                            </div>
                                <div class="card-body">
                                <div style="text-align: center;">
                                    @foreach ($equipo->participantes as $participante)
                                    @php
                                        $esCapitan = $equipo->capitan == $participante->cedula;
                                    @endphp
                                    <div class="{{ $esCapitan ? 'nombre-capitan' : '' }}">
                                        {{ $participante->nombre }} {{ $participante->apellido }}
                                    </div>
                                @endforeach
                                    <button class="btn btn-dark mt-3" data-bs-target="#exampleModalToggle{{ $equipo->id_equipo }}" data-bs-toggle="modal" @if($equipo->capitan) disabled @endif>
                                        <i class="fa-solid fa-crown"></i><strong> CAPITÁN</strong>
                                    </button>
                                </div>
                                <div class="modal fade" id="exampleModalToggle{{ $equipo->id_equipo }}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalToggleLabel">ASIGNAR CAPITÁN DEL EQUIPO</h1>                                                   
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('asignar.capitan') }}" method="POST">
                                                @csrf
                                                <select class="form-select" name="participante_id" aria-label="Select example">
                                                    @foreach($equipo->participantes as $participante)
                                                        <option value="{{ $participante->cedula }}">{{ $participante->nombre }} {{ $participante->apellido }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="equipo_id" value="{{ $equipo->id_equipo }}">
                                                <button type="submit" class="btn btn-success mt-3 fw-bold">Asignar capitán</button>
                                            </form>
                                            
                                        </div>
                                    </div>                                                  
                                </div>                                                
                            </div>
                            </div>
                        </div>
                    </div>
                    @php
    $contador++;
    @endphp
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>