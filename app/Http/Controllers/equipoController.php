<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Participante;
use App\Models\Torneo;
use Illuminate\Http\Request;

class equipoController extends Controller
{

   public function generarEquipos($id_torneo)
{
    // Obtén todos los participantes con estado "aceptado" que aún no están asignados a un equipo
    $participantesSinEquipo = Participante::where('estado', 'aceptado')
        ->whereNull('fk_id_equipo')
        ->get();

    $participantesCount = $participantesSinEquipo->count();
    $equipoSize = 4;

    while ($participantesCount >= $equipoSize) {
        // Crea un nuevo equipo
        $equipo = new Equipo();
        $equipo->estado_equipo = 'CALIFICADO';
        $equipo->puntos = 0;
        $equipo->fk_id_torneo = $id_torneo;
        $equipo->save();

        // Asigna aleatoriamente 4 participantes al equipo
        $randomParticipantes = $participantesSinEquipo->random($equipoSize);
        $randomParticipantesIds = $randomParticipantes->pluck('cedula');

        Participante::whereIn('cedula', $randomParticipantesIds)
            ->update(['fk_id_equipo' => $equipo->id_equipo]);

        // Actualiza el contador de participantes sin equipo
        $participantesSinEquipo = $participantesSinEquipo->whereNotIn('cedula', $randomParticipantesIds);
        $participantesCount = $participantesSinEquipo->count();
    }

    // Participantes que no pudieron ser asignados a un equipo
    $participantesRestantes = $participantesSinEquipo->all();

    // Si quedan participantes no asignados y son menos de 4, muestra un mensaje de que no hay suficientes integrantes.
    $message = 'No hay suficientes participantes para formar un equipo completo. Participantes restantes:';
    if ($participantesCount > 0 && $participantesCount < $equipoSize) {
        $participantesRestantes = $participantesSinEquipo->all();
        return redirect()->back()->with('participantesRestantes', $participantesRestantes);
    }
    

    return redirect()->back()->with('participantesRestantes', $participantesRestantes);
}

    
public function participantes($id_equipo)
{
    $equipo = Equipo::find($id_equipo);
    $participantes = Participante::where('fk_id_equipo', $id_equipo)->get();
    return view('participantesEquipo', ['equipo' => $equipo, 'participantes' => $participantes]);
}
    
}
    
    

