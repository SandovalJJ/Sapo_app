<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Torneo;
use App\Models\Equipo;
use App\Models\Participante;

class torneoController extends Controller
{

    public function show($id_torneo)
{
    // Recupera el torneo con el id_torneo proporcionado
    $torneo = Torneo::where('id_torneo', $id_torneo)->first();

    if (!$torneo) {
        // Maneja la situación en la que no se encuentra el torneo
        return redirect()->route('admin')->with('error', 'Torneo no encontrado.');
    }

    return view('torneoShow', compact('torneo'));
}


public function createTorneo(Request $request){
    $incomingFields = $request->validate([
        'nombre' => 'required',
        'fecha' => 'required',
    ]);

    Torneo::create($incomingFields);

    // Redirige de nuevo a la página actual
    return redirect()->back();
}

public function equipos($id_torneo)
{
    $torneo = Torneo::find($id_torneo);
    $equipos = Equipo::where('fk_id_torneo', $id_torneo)->get();
    return view('torneoShow', ['torneo' => $torneo, 'equipos' => $equipos]);
}

public function crearEquiposAlAzar()
{
    // Obtén todos los participantes de la base de datos
    $participantes = Participante::all();

    // Mezcla los participantes de forma aleatoria
    $participantesAleatorios = $participantes->shuffle();

    // Divide los participantes en equipos de 4
    $equipos = $participantesAleatorios->chunk(4);

    // Crea equipos y asigna la variable foránea a cada participante
    foreach ($equipos as $grupoParticipantes) {
        $equipo = new Equipo();
        $equipo->estado_equipo = 'Activo'; // Puedes establecer el estado del equipo como desees
        $equipo->save();

        foreach ($grupoParticipantes as $participante) {
            $participante->fk_id_equipo = $equipo->id;
            $participante->save();
        }
    }

    return redirect()->route('admin')->with('success', 'Equipos creados al azar.');
}

}

