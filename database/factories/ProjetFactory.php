<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Projet>
 */
class ProjetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

            return [
                'nom' => $this->faker->words(3, true),
                'image' => 'default_project.jpg',
                'objectif' => $this->faker->sentence,
                'description' => $this->faker->paragraph,
                'echeance' => $this->faker->date,
                'budget' => $this->faker->randomNumber(5),
                'etat' => $this->faker->randomElement(['Disponible', 'Financé']),
                'categorie_id' => Categorie::factory(),
                'user_id' => User::factory(),
            ];

    }
}
