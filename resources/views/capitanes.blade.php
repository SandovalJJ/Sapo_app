<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Torneo sapo - Coopserp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
  </head>
  <body>
    
    <div class="card text-center">
        <div class="card-header">
          <ul class="nav nav-pills card-header-pills">
           
            <li class="nav-item">
                <a class="nav-link" href="/" style="color: green;">Registro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="\admin" style="color: green;">Torneos</a>
            </li>
            <li class="nav-item">
               
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
        <div class="container">
            <h1>Seleccionar Capitán</h1>
            <form method="POST" action="">
                @csrf
                <table class="table">
                    <thead>
                        <tr>
                            <th>Equipo</th>
                            <th>Capitán Actual</th>
                            <th>Nuevo Capitán</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($equipos as $equipo)
                            <tr>
                                <td>{{ $equipo->id_equipo }}</td>
                                <td>
                                    @if ($equipo->capitan)
                                        {{ $equipo->capitan->name }}
                                    @else
                                        No tiene capitán
                                    @endif
                                </td>
                                <td>
                                    @if (!$equipo->capitan)
                                        <select name="capitan[{{ $equipo->id }}]">
                                            <option value="">Seleccionar Capitán</option>
                                            @foreach($equipo->participantes as $participante)
                                                <option value="{{ $participante->id }}">{{ $participante->name }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        Ya tiene un capitán
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary mb-3">Guardar Capitanes</button> 
            </form>
        </div>
    @endsection
    
     





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>



