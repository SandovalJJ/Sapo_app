<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enfrentamiento extends Model
{
    protected $table = 'enfrentamientos';
    protected $primaryKey = 'id_enfrentamiento';
    public $timestamps = false;

    protected $fillable = [
        'fk_id_torneo',
        'id_equipo_local',
        'id_equipo_visitante',
        'resultado',
    ];

    public function equipoLocal()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo_local');
    }

    public function equipoVisitante()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo_visitante');
    }

    public function participantesEquipoLocal()
{
    return $this->equipoLocal->participantes();
}

public function participantesEquipoVisitante()
{
    return $this->equipoVisitante->participantes();
}
}