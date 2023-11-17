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

    </header>

    <main>
        @yield('content') <!-- Aquí se incluirá el contenido específico de cada vista -->
       
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
