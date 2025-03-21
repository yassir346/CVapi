<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Competence;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Competence>
 */
class CompetenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'filename' => $this->faker->word,  
            'file_path' =>$this->faker->word,
            'file_type' => 'pdf',
            'file_size' => $this->faker,
            'user_id' => User::inRandomOrder()->first()->id, // Assign a random user ID from the users table
        ];
    }
}
