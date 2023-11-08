<?php

namespace App\Http\Controllers;

use App\Models\Enfrentamiento;
use App\Models\Equipo;
use App\Models\Participante;
use App\Models\Torneo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class enfrentamientoController extends Controller
{
     


    public function crearEnfrentamientos($id_torneo) {
        $torneo = Torneo::find($id_torneo);
        $equipos = Equipo::where('fk_id_torneo', $id_torneo)->get();
        
        // Aleatorizar la lista de equipos
        $equiposAleatorios = $equipos->shuffle();
        
        // Crear enfrentamientos
        $ronda = 1; // Inicializamos la ronda en 1
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
            $enfrentamiento->fk_id_torneo = $id_torneo; // Reemplaza con el valor correcto del torneo.
            $enfrentamiento->id_equipo_local = $equipoLocal['id_equipo'];
            $enfrentamiento->id_equipo_visitante = $equipoVisitante['id_equipo'];
            $enfrentamiento->ronda = $ronda;
            $enfrentamiento->save();
        }
    
        // Si queda un equipo sin emparejar en caso de un número impar de equipos
        if (count($equiposDisponibles) > 0) {
            $indiceLocal = array_rand($equiposDisponibles);
            $equipoLocal = $equiposDisponibles[$indiceLocal];
            unset($equiposDisponibles[$indiceLocal]);
            $equiposEmparejados[] = $equipoLocal['id_equipo'];
            $enfrentamiento = new Enfrentamiento();
            $enfrentamiento->fk_id_torneo = $id_torneo;
            $enfrentamiento->id_equipo_local = $equipoLocal['id_equipo'];
            $enfrentamiento->ronda = $ronda;
            $enfrentamiento->resultado = $equipoLocal['id_equipo'];
            $enfrentamiento->save();
        }
    
        // Redireccionar a una vista o hacer una respuesta JSON, según tus necesidades
        return redirect()->back();
    }
    

       public function enfrentamientos($id_torneo)
    {
        $torneo = Torneo::find($id_torneo);
        $enfrentamientos = Enfrentamiento::where('fk_id_torneo', $id_torneo)->get();
        $enfrentamientoss = Enfrentamiento::where('fk_id_torneo', $id_torneo)->get();
        $resultados = Enfrentamiento::where('fk_id_torneo', $id_torneo)->get();
        return view('enfrentamientos', ['torneo' => $torneo, 'enfrentamientos' => $enfrentamientos, 'enfrentamientoss' => $enfrentamientoss, 'resultados' => $resultados]);
    }

    public function index()
    {     
        $enfrentamientos = Enfrentamiento::whereNull('resultado')->get();
        $enfrentamientoss = Enfrentamiento::whereNull('resultado')->get();
        $enfrentamientoss = $enfrentamientoss->skip(1);
        $resultados = Enfrentamiento::whereNotNull('resultado')->get();

        return view('enfrentamientos', compact('enfrentamientos', 'enfrentamientoss', 'resultados'));
    }

 

}
