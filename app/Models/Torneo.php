<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    use HasFactory;

    protected $table = 'torneos';
    protected $primaryKey = 'id_torneo';
    public $timestamps = false;

    protected $fillable = ['nombre', 'fecha', 'ronda'];

    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'fk_id_torneo');
    }
}