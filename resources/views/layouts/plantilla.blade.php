<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Aplicación</title>
    <!-- Estilos de Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Estilos de DataTables Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    @yield('css') <!-- Aquí se incluirán los estilos específicos de cada vista -->
</head>
<body>
    <header>
        <!-- Barra de navegación u otros elementos comunes -->
    </header>

    <main>
        @yield('molde') <!-- Aquí se incluirá el contenido específico de cada vista -->
     

        <body>
            @auth
            
                <div class="card text-center">
                    <div class="card-header">
                      <ul class="nav nav-pills card-header-pills">
                       
                        <li class="nav-item">
                            <a class="nav-link" href="/" style="color: green;">Registro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="" style="background-color: #198754;">Admin</a>
                        </li>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="btn btn-link text-success">Cerrar sesión</button>
                            </form> 
                      </ul>

                      
                
                    </div>
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








    </main>

    <footer>
        <!-- Pie de página u otros elementos comunes -->
    </footer>

    <!-- Scripts de jQuery, DataTables y DataTables Bootstrap 5 -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    @yield('js') <!-- Aquí se incluirán los scripts específicos de cada vista -->
</body>
</html>
