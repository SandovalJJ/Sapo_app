<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';
    protected $primaryKey = 'id_equipo';
    public $timestamps = false;

    protected $fillable = ['estado_equipo', 'puntos', 'fk_id_torneo'];

    public function torneo()
    {
        return $this->belongsTo(Torneo::class, 'fk_id_torneo');
    }

    public function participantes()
    {
        return $this->hasMany(Participante::class, 'fk_id_equipo');
    }
}
