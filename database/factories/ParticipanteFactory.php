<?php

namespace Database\Factories;

use App\Models\Participante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Participante>
 */
class ParticipanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Participante::class;

    public function definition()
    {
        return [
            'cedula' => $this->faker->unique()->numberBetween(1000000, 9999999),
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'telefono' => $this->faker->phoneNumber,
            'correo' => $this->faker->unique()->safeEmail,
            'puntos' => $this->faker->numberBetween(0, 100),
            'agencia' => $this->faker->word,
            'estado' => $this->faker->randomElement(['aceptado']),
            'fk_id_equipo' => null, // Para asegurarse de que inicialmente no tienen equipo asignado.
        ];
    }
}
