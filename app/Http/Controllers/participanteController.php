<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use App\Models\Participante;
use App\Models\User;



class participanteController extends Controller
{
    //CREAR UN NUEVO PARTICIPANTE
    public function createParticipante(Request $request){
        $incomingFields = $request->validate([
            'cedula' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required|integer',
            'correo' => 'required',
            'agencia' => 'required',
        ]);
        $existingParticipante = Participante::where('cedula', $incomingFields['cedula'])->first();

    if ($existingParticipante) {
        return redirect()->back()->with('error', 'La cédula ya existe. Introduce una cédula única.');
    }

    Participante::create($incomingFields);
    return redirect('/');
}

//CONSULTAR PARTICIPANTES
public function consultarParticipantes() {
    $participantes = Participante::where('estado', 'pendiente')->get();
    return view('participantes', ['participantes' => $participantes]);
}
    
    
//METODOSO PARA ACEPTAR O RECHAZAR UN PARTICIPANTE
    public function aceptar($cedula)
{
    $participante = Participante::find($cedula);
    if (!$participante) {
    }
    $participante->update(['estado' => 'aceptado']);
    return redirect('/participantes');
}

public function rechazar($cedula)
{

    $participante = Participante::find($cedula);
    if (!$participante) {
    }
    $participante->update(['estado' => 'rechazado']);
    return redirect('/participantes');
}
//metodos para aceptar o rechazar registros
public function aceptarRegistro($cedula)
{
    $participante = Participante::find($cedula);
    if (!$participante) {
    }
    $participante->update(['estado' => 'aceptado']);
    return redirect('/aceptados');
}

public function rechazarRegistro($cedula)
{
    $participante = Participante::find($cedula);
    if (!$participante) {
    }
    $participante->update(['estado' => 'rechazado']);
    return redirect('/aceptados');
}
//metodo para guardar puntos
public function guardarPuntos(Request $request)
{
    $puntos = $request->input('puntos');
    foreach ($puntos as $participanteId => $nuevosPuntos) {
        $participante = Participante::find($participanteId);

        if ($participante) {
            $participante->puntos = $nuevosPuntos;
            $participante->save();
        }
    }

    $equipoId = $participante->fk_id_equipo;
    $sumaPuntos = Participante::where('fk_id_equipo', $equipoId)->sum('puntos');

    $equipo = Equipo::find($equipoId);
    if ($equipo) {
        $equipo->puntos = $sumaPuntos;
        $equipo->save();
    }

    return redirect()->back()->with('success', 'Puntos actualizados con éxito');
}

//metodo para asignar un capitan automaticamente
public function asignarCapitan(Request $request)
{
    $equipoId = $request->input('equipo_id');
    $participanteId = $request->input('participante_id');
    Equipo::where('id_equipo', $equipoId)->update(['capitan' => $participanteId]);
    User::updateOrCreate(
        ['name' => $participanteId],
        [
            'name' => $participanteId, 
            'password' => bcrypt($participanteId),
            'rol' => 'capitan'
        ]
    );
    return redirect()->back()->with('success', 'Capitán asignado correctamente.');
}





}



