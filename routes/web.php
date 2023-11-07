<?php

use App\Http\Controllers\enfrentamientoController;
use Illuminate\Support\Facades\Route;
use App\Models\Participante;
use App\Models\Torneo;
use App\Models\Equipo;
use App\Http\Controllers\participanteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\torneoController;
use App\Http\Controllers\equipoController;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/equipos', function () {
    return view('equipos');
});

Route::get('/participantes', function () {
    return view('participantes');
});

Route::get('/aceptados', function () {
    return view('aceptados');
});

Route::get('/participantesEquipo', function () {
    return view('participantesEquipo');
});

Route::get('/enfrentamientos', function () {
    return view('enfrentamientos');
});

//RUTAS DE LOG IN
Route::post('/login2',[UserController::class, 'login2'])->name('iniciar');
Route::post('/register', [UserControllerller::class, 'register']);
Route::post('/logout',[UserController::class, 'logout']);


//RUTAS DE PARTICIPANTES
Route::post('/create-participante',[participanteController::class,'createParticipante']);

Route::get('/participantes', function () {
    $participantes = Participante::where('estado', 'pendiente')->get();
    return view('participantes', ['participantes' => $participantes]);
});

Route::get('/aceptados', function () {
    $participantes= Participante::all();
    return view('aceptados',['participantes'=> $participantes]);
});


Route::post('/aceptar-participante/{id}', [participanteController::class, 'aceptar'])->name('participante.aceptar');

Route::post('/rechazar-participante/{id}', [participanteController::class, 'rechazar'])->name('participante.rechazar');

////

Route::post('/aceptar-registro/{id}', [participanteController::class, 'aceptarRegistro'])->name('registro.aceptar');

Route::post('/rechazar-registro/{id}', [participanteController::class, 'rechazarRegistro'])->name('registro.rechazar');



Route::get('/admin', function () {
    $torneos= Torneo::all();
    return view('admin',['torneos'=> $torneos]);
});


//RUTAS DE TORNEOS
Route::get('/torneo/{id_torneo}/', [torneoController::class, 'show'])->name('torneoShow');
Route::post('/create-torneo', [torneoController::class, 'createTorneo']);



//RUTAS DE EQUIPOS
Route::get('/crear-equipos-azar', [torneoController::class, 'crearEquiposAlAzar'])->name('crear_equipos_azar');
Route::get('/torneo/{id_torneo}/equipos', [torneoController::class, 'equipos'])->name('equipos');

Route::get('/generar-equipos/{id_torneo}', [equipoController::class, 'generarEquipos'])->name('generar.equipos');
Route::get('/equipos/{id_equipo}', [equipoController::class, 'participantes'])->name('participantes');

Route::post('/guardar-puntos', [ParticipanteController::class, 'guardarPuntos'])->name('guardar-puntos');



//RUTAS ENFRENTAMIENTOS

Route::get('/enfrentamiento', [enfrentamientoController::class, 'mostrarEnfrentamientos'])->name('enfrentamiento');
Route::get('/crear-enfrentamientos', [enfrentamientoController::class, 'crearEnfrentamientos'])->name('crear_enfrentamientos');



