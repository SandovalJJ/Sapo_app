<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enfrentamiento de Equipos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .bg-verde {
            background-color: #4CAF50; /* Un tono de verde */
        }
        .bg-amarillo {
            background-color: #FFEB3B; /* Un tono de amarillo */
        }
        .texto-elegante {
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .navbar-dark .navbar-nav .nav-link {
            color: #FFEB3B; /* Color de texto amarillo para los links */
        }
        .navbar-dark .navbar-brand {
            color: #4CAF50; /* Color verde para el brand */
        }
        .card-participante {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .sidebar-link {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 5px;
            color: #333;
            text-decoration: none;
        }
        .sidebar-link:hover {
            background-color: #ececec;
        }
    </style>
</head>
<body>

<!-- Navbar -->
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

<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <h3 class="bg-dark rounded text-white p-2">Todos los Enfrentamientos</h3>

            <div class="list-group">
                @foreach ($enfrentamientos as $enfrentamiento)
                    <a href="{{ route('enfrentamientos.show', $enfrentamiento->id_enfrentamiento) }}" class="sidebar-link">
                       Equipo {{ $enfrentamiento->equipoLocal->id_equipo ?? 'Equipo Local' }} vs Equipo {{ $enfrentamiento->equipoVisitante->id_equipo ?? 'no asignado' }}
                    </a>
                @endforeach
            </div>
            
            <br>
            <h3 class="bg-dark rounded text-white p-2">Ganadores</h3>

            <div class="list-group">
                @foreach ($resultados as $resultado)
                    <ul class="list-group mb-1">
                        <li class="list-group-item list-group-item-success">
                            <strong>Equipo {{ $resultado->id_equipo }}</strong>
                        </li>
                    </ul>
                @endforeach
            </div>
            

        </div>
        
        <div class="col-md-9">

            <h1 class="bg-dark rounded text-white p-2"><strong>ENFRENTAMIENTO</strong></h1>

            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('guardar.resultados', $enfrentamientoActual->id_enfrentamiento) }}" method="POST">
                        @csrf
                    <h2 class="bg-warning rounded text-dark p-2">
                        Equipo Local <br> [Puntos: {{$enfrentamientoActual->equipoLocal->puntos}}]
                    </h2>
                    @foreach ($enfrentamientoActual->equipoLocal->participantes as $participante)
                        <div class="card-participante">
                            <p class="texto-elegante"><strong>{{ $participante->nombre }} {{ $participante->apellido }}</strong></p>
                            <input type="number" class="form-control" value="{{ $participante->puntos }}" name="puntos_local[{{ $participante->cedula }}]">
                        </div>

                    @endforeach
                </div>

                <div class="col-md-6">
                    <h2 class="bg-warning rounded text-dark p-2">
                        Equipo Visitante <br> [Puntos: {{$enfrentamientoActual->equipoVisitante->puntos}}]
                    </h2>
                    @foreach ($enfrentamientoActual->equipoVisitante->participantes as $participante)
                        <div class="card-participante">
                            <p class="texto-elegante"><strong>{{ $participante->nombre }} {{ $participante->apellido }}</strong></p>
                            <input type="number" class="form-control" value="{{ $participante->puntos }}" name="puntos_visitante[{{ $participante->cedula }}]">
                            {{-- otros detalles del participante --}}
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-3 mb-3">guardar</button>
            </form>
            <form action="{{ route('determinar.ganador', $enfrentamientoActual->id_enfrentamiento) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-info mt-3 mb-3">Determinar Ganador</button>
            </form>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
