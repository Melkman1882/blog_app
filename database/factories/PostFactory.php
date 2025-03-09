<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $imageNames = [
            'animal.PNG', 'businessnews.PNG', 'coffeeshop.PNG',
            'gym.PNG', 'holiday.PNG', 'home.PNG',
            'outdoor.PNG', 'skateshop.PNG', 'tech.PNG', 'techhome.PNG'
        ];

        return [
            'title' => $this->faker->sentence(6), // Generates a random title
            'content' => $this->faker->paragraphs(5, true), // Generates multiple paragraphs
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(), // Random or new user
            'image' => 'post_images/' . $this->faker->randomElement($imageNames), // Assign a random image
        ];
    }
}
