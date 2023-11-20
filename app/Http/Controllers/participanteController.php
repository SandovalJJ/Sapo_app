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
        // Si se encuentra un participante con la misma cédula, redirige con un mensaje de error
        return redirect()->back()->with('error', 'La cédula ya existe. Introduce una cédula única.');
    }

    // Si no existe un participante con la misma cédula, crea el nuevo participante
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

// --------------------------

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

    // Obtener el equipo al que pertenecen los participantes
    $equipoId = $participante->fk_id_equipo;

    // Calcular la suma de los puntos de los participantes del equipo
    $sumaPuntos = Participante::where('fk_id_equipo', $equipoId)->sum('puntos');

    // Actualizar el atributo de puntos del equipo con la suma calculada
    $equipo = Equipo::find($equipoId);
    if ($equipo) {
        $equipo->puntos = $sumaPuntos;
        $equipo->save();
    }

    return redirect()->back()->with('success', 'Puntos actualizados con éxito');
}


public function asignarCapitan(Request $request)
{
    $equipoId = $request->input('equipo_id');
    $participanteId = $request->input('participante_id');

    // Actualizar la columna capitan en la tabla equipo
    Equipo::where('id_equipo', $equipoId)->update(['capitan' => $participanteId]);

    // Crear o actualizar un usuario en la tabla users
    User::updateOrCreate(
        ['name' => $participanteId], // Buscar por el nombre (cedula)
        [
            'name' => $participanteId, 
            'password' => bcrypt($participanteId), // Encriptar la cédula para la contraseña
            'rol' => 'capitan'
        ]
    );

    // Redirigir de vuelta con un mensaje de éxito
    return redirect()->back()->with('success', 'Capitán asignado correctamente.');
}





}



