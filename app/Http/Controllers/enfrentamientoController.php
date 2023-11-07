<?php

namespace App\Http\Controllers;

use App\Models\Enfrentamiento;
use App\Models\Equipo;
use Illuminate\Http\Request;

class enfrentamientoController extends Controller
{
    public function crearEnfrentamientos() {
        // Obtener la lista de equipos desde la base de datos
        $equipos = Equipo::all();
    
        // Aleatorizar la lista de equipos
        $equiposAleatorios = $equipos->shuffle();
    
        // Crear enfrentamientos
        $ronda = 1; // Inicializamos la ronda en 1
    
        $equiposDisponibles = $equiposAleatorios->toArray();
    
        while (count($equiposDisponibles) >= 2) {
            $indiceLocal = array_rand($equiposDisponibles);
            $equipoLocal = $equiposDisponibles[$indiceLocal];
            unset($equiposDisponibles[$indiceLocal]);
    
            $indiceVisitante = array_rand($equiposDisponibles);
            $equipoVisitante = $equiposDisponibles[$indiceVisitante];
            unset($equiposDisponibles[$indiceVisitante]);
    
            // Crear un enfrentamiento entre los dos equipos
            $enfrentamiento = new Enfrentamiento();
            $enfrentamiento->fk_id_torneo = 1; // Reemplaza con el valor correcto del torneo.
            $enfrentamiento->id_equipo_local = $equipoLocal['id_equipo'];
            $enfrentamiento->id_equipo_visitante = $equipoVisitante['id_equipo'];
            $enfrentamiento->ronda = $ronda;
            $enfrentamiento->save();
        }
    
        // Si queda un equipo sin emparejar en caso de un número impar de equipos
        if (count($equiposDisponibles) > 0) {
            // Puedes decidir qué hacer con el equipo sin oponente, como avanzarlo a la siguiente ronda o marcarlo como descanso.
        }
    
        // Redireccionar a una vista o hacer una respuesta JSON, según tus necesidades
        return redirect()->back();
    }
    
    

}
