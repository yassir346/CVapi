<?php

namespace Database\Factories;

use App\Models\Cv;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CvFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cv::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Generate a random file name and other details
        return [
            'filename' => $this->faker->word . '.pdf',  // Random filename with .pdf extension
            'file_path' => 'cvs/' . $this->faker->word . '.pdf', // Path for file storage
            'file_type' => 'pdf', // Assuming you're using PDF files, change if necessary
            'file_size' => $this->faker->numberBetween(1000, 5000), // Random file size between 1KB and 5KB
            'user_id' => User::inRandomOrder()->first()->id, // Assign a random user ID from the users table
        ];
    }
}
