<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Torneo SAPO - ENFRENTAMIENTOS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Roboto:wght@400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/056e693a0d.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
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

        <div class="col-md-9 text-center">
            <h1 class="bg-dark rounded text-white p-2 "><strong>ENFRENTAMIENTO</strong></h1>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('guardar.resultados', $enfrentamientoActual->id_enfrentamiento) }}" method="POST">
                        @csrf
                    <h2 class="bg-warning rounded text-dark p-2">
                        Equipo {{$enfrentamientoActual->equipoLocal->id_equipo}} <br> [Puntos: {{$enfrentamientoActual->equipoLocal->puntos}}]
                    </h2>
                    @foreach ($enfrentamientoActual->equipoLocal->participantes as $participante)
                        <div class="card-participante">
                            <p class="texto-elegante"><strong>{{ $participante->nombre }} {{ $participante->apellido }}</strong></p>
                            <input type="number" class="form-control" 
                             name="puntos_local[{{ $participante->cedula }}]">
                        </div>

                    @endforeach
                </div>

                <div class="col-md-6">
                    <h2 class="bg-warning rounded text-dark p-2">
                        Equipo {{$enfrentamientoActual->equipoVisitante->id_equipo}} <br> [Puntos: {{$enfrentamientoActual->equipoVisitante->puntos}}]
                    </h2>
                    @foreach ($enfrentamientoActual->equipoVisitante->participantes as $participante)
                        <div class="card-participante">
                            <p class="texto-elegante"><strong>{{ $participante->nombre }} {{ $participante->apellido }}</strong></p>
                            <input type="number" class="form-control"  name="puntos_visitante[{{ $participante->cedula }}]">
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-3 mb-3">guardar</button>
            </form>
            <div>

                <form action="{{ route('determinar.ganador', $enfrentamientoActual->id_enfrentamiento) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success mt-3 mb-3">Determinar Ganador</button>
                </form>

                @if(isset($siguienteEnfrentamientoId))
                <a href="{{ route('enfrentamientos.show', $siguienteEnfrentamientoId) }}" class="btn btn-primary mt-3 mb-3">Siguiente Enfrentamiento</a>
                @else   
                <button class="btn btn-secondary mt-3 mb-3" disabled>No hay más enfrentamientos</button>
                @endif  
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
