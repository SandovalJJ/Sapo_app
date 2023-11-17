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
        $participantes = $equipo->participantes;

        $participantesSinEquipo = Participante::whereNull('fk_id_equipo')
                                       ->where('estado', 'aceptado')
                                       ->get();

        return view('participantesEquipo', ['participantes' => $participantes, 'participantesSinEquipo' => $participantesSinEquipo, 'id_equipo' => $id_equipo]);
    }

    public function asignarParticipante(Request $request)
    {
        // Validación básica
        $request->validate([
            'participante_id' => 'required|exists:participantes,cedula',
            'equipo_id' => 'required|exists:equipos,id_equipo' // Asegúrate de que el id de equipo exista
        ]);

        // Buscar el participante
        $participante = Participante::find($request->participante_id);

        // Asignar el equipo al participante
        $participante->fk_id_equipo = $request->equipo_id;
        $participante->save();

        return back()->with('success', 'Participante asignado al equipo correctamente.');
    }

    public function removerParticipante(Request $request)
    {
        $participante = Participante::find($request->participante_id);
        $participante->fk_id_equipo = null;
        $participante->save();
        return back();
    }

    public function capitanes($id_torneo)
    {
        $torneo = Torneo::find($id_torneo);
        $equipos = Equipo::where('fk_id_torneo', $id_torneo)->get();
        
        return view('capitanes', ['torneo' => $torneo, 'equipos' => $equipos]);
        
    }

}