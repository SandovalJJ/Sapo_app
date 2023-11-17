<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;

    protected $table = 'participantes';
    protected $primaryKey = 'cedula';
    public $timestamps = false;

    protected $fillable = ['cedula', 'nombre', 'apellido', 'telefono', 'correo', 'puntos','puntosTemporal', 'agencia', 'estado', 'fk_id_equipo'];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'fk_id_equipo');
    }
}
