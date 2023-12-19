<?php

namespace App\Http\Controllers;

use App\Models\Enfrentamiento;
use Illuminate\Http\Request;
use App\Models\Torneo;
use App\Models\Equipo;
use App\Models\Participante;

class enfrentamientoController extends Controller
{

public function mostrarEnfrentamiento($id_enfrentamiento)
{
    $enfrentamientoActual = Enfrentamiento::with('equipoLocal.participantes', 'equipoVisitante.participantes')->find($id_enfrentamiento);
    $enfrentamientos = Enfrentamiento::whereNull('resultado')->get();
    $resultados = Enfrentamiento::whereNotNull('resultado')
    ->join('equipos', 'enfrentamientos.resultado', '=', 'equipos.id_equipo')
    ->where('equipos.estado_equipo', 'CALIFICADO')
    ->select('equipos.id_equipo') // Selecciona solo la columna id_equipo de la tabla equipos
    ->distinct() // Asegúrate de que los ID de los equipos sean únicos
    ->get();

    $todosLosEnfrentamientos = Enfrentamiento::all(); // Asumiendo que no son demasiados para cargar
      $siguienteEnfrentamiento = Enfrentamiento::where('id_enfrentamiento', '>', $id_enfrentamiento)
                                             ->whereNull('resultado')
                                             ->orderBy('id_enfrentamiento')
                                             ->first();
    

    
    if (!$enfrentamientoActual) {
        abort(404);
    }

    return view('enfrentamientos', compact('enfrentamientoActual', 'todosLosEnfrentamientos', 'enfrentamientos', 'resultados', 'siguienteEnfrentamiento'));
}

public function crearEnfrentamientos($id_torneo) {
    $torneo = Torneo::find($id_torneo);
    // Aquí aseguramos que solo seleccionemos equipos calificados
    $equipos = Equipo::where('fk_id_torneo', $id_torneo)->where('estado_equipo', 'CALIFICADO')->get();

    // Verificar si alguno de los equipos ya tiene un enfrentamiento
    $equiposConEnfrentamiento = Enfrentamiento::whereHas('equipoLocal', function($query) use ($id_torneo) {
        $query->where('fk_id_torneo', $id_torneo);
    })->orWhereHas('equipoVisitante', function($query) use ($id_torneo) {
        $query->where('fk_id_torneo', $id_torneo);
    })->get();

    if ($equiposConEnfrentamiento->isNotEmpty()) {
        // Aquí puedes personalizar la respuesta de error
        session()->flash('error', 'No se pueden crear más enfrentamientos, ya existen partidos programados.');
        return redirect()->back();
    }
    
    // Aleatorizar la lista de equipos
    $equiposAleatorios = $equipos->shuffle();
    
    // Crear enfrentamientos
    $equiposDisponibles = $equiposAleatorios->toArray();
    $equiposEmparejados = [];

    while (count($equiposDisponibles) >= 2) {
        $indiceLocal = array_rand($equiposDisponibles);
        $equipoLocal = $equiposDisponibles[$indiceLocal];
        unset($equiposDisponibles[$indiceLocal]);

        // Buscar un equipo visitante que no haya sido emparejado previamente
        do {
            $indiceVisitante = array_rand($equiposDisponibles);
            $equipoVisitante = $equiposDisponibles[$indiceVisitante];
        } while (in_array($equipoVisitante['id_equipo'], $equiposEmparejados));
        
        unset($equiposDisponibles[$indiceVisitante]);
        $equiposEmparejados[] = $equipoLocal['id_equipo'];
        $equiposEmparejados[] = $equipoVisitante['id_equipo'];

        // Crear un enfrentamiento entre los dos equipos
        $enfrentamiento = new Enfrentamiento();

        $enfrentamiento->id_equipo_local = $equipoLocal['id_equipo'];
        $enfrentamiento->id_equipo_visitante = $equipoVisitante['id_equipo'];
        $enfrentamiento->save();
    }

    // Si queda un equipo sin emparejar en caso de un número impar de equipos
    if (count($equiposDisponibles) > 0) {
        $indiceLocal = array_rand($equiposDisponibles);
        $equipoLocal = $equiposDisponibles[$indiceLocal];
        unset($equiposDisponibles[$indiceLocal]);
        $equiposEmparejados[] = $equipoLocal['id_equipo'];
        $enfrentamiento = new Enfrentamiento();

        $enfrentamiento->id_equipo_local = $equipoLocal['id_equipo'];
        // Suponiendo que un equipo sin emparejar gana automáticamente su "enfrentamiento"
        $enfrentamiento->resultado = $equipoLocal['id_equipo'];
        $enfrentamiento->save();
    }

    // Redireccionar a una vista o hacer una respuesta JSON, según tus necesidades
    return redirect()->back();
}


//GUARDA LOS PUNTOS QUE TIENE ACTUALMENTE

public function guardarResultados(Request $request, $id_enfrentamiento)
{
    $enfrentamiento = Enfrentamiento::with(['equipoLocal', 'equipoVisitante'])->findOrFail($id_enfrentamiento);

    // Sumar y guardar puntos para el equipo local
    $puntosLocal = array_sum($request->puntos_local);
    $equipoLocal = $enfrentamiento->equipoLocal;
    $equipoLocal->puntos += $puntosLocal;
    $equipoLocal->save();

    // Sumar y guardar puntos para el equipo visitante
    $puntosVisitante = array_sum($request->puntos_visitante);
    $equipoVisitante = $enfrentamiento->equipoVisitante;
    $equipoVisitante->puntos += $puntosVisitante;
    $equipoVisitante->save();

    // Actualizar puntos de cada participante local sumándolos a los existentes
    foreach ($request->puntos_local as $cedula => $puntos) {
        $participante = Participante::findOrFail($cedula);
        $participante->puntos += $puntos; // Suma los nuevos puntos a los existentes
        $participante->save();
    }

    // Actualizar puntos de cada participante visitante sumándolos a los existentes
    foreach ($request->puntos_visitante as $cedula => $puntos) {
        $participante = Participante::findOrFail($cedula);
        $participante->puntos += $puntos; // Suma los nuevos puntos a los existentes
        $participante->save();
    }

    // Redirige o devuelve una respuesta según sea necesario
    return back()->with('success', 'Resultados guardados correctamente.');
}


//DETERMINA EL GANADOR DEL ENFRENTAMIENTO BASADO EN LA CANTIDAD DE PUNTOS

public function determinarGanador(Request $request, $id_enfrentamiento)
{
    $enfrentamiento = Enfrentamiento::with(['equipoLocal', 'equipoVisitante'])->findOrFail($id_enfrentamiento);

    // Compara los puntajes de los equipos
    if ($enfrentamiento->equipoLocal->puntos > $enfrentamiento->equipoVisitante->puntos) {
        $ganador = $enfrentamiento->equipoLocal;
        $perdedor = $enfrentamiento->equipoVisitante;
    } else if ($enfrentamiento->equipoLocal->puntos < $enfrentamiento->equipoVisitante->puntos) {
        $ganador = $enfrentamiento->equipoVisitante;
        $perdedor = $enfrentamiento->equipoLocal;
    } else {
        // En caso de empate, puedes decidir cómo manejarlo
        return back()->with('error', 'Los equipos tienen el mismo puntaje.');
    }

    // Actualiza el resultado del enfrentamiento
    $enfrentamiento->resultado = $ganador->id_equipo;
    $enfrentamiento->save();

    // Descalifica al equipo perdedor
    $perdedor->estado_equipo = 'descalificado';
    $perdedor->save();

    return back()->with('success', 'El ganador ha sido determinado y el estado actualizado.');
}






}
