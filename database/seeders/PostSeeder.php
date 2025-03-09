<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have users before seeding posts
        if (User::count() > 0) {
            $imageNames = [
                'animal.PNG', 'businessnews.PNG', 'coffeeshop.PNG',
                'gym.PNG', 'holiday.PNG', 'home.PNG',
                'skateshop.PNG', 'tech.PNG'
            ];

            // Define the correct image path inside storage
            $storagePath = 'storage/app/public/';

            Post::factory(10)->create()->each(function ($post) use ($imageNames, $storagePath) {
                $post->update([
                    'image' => $storagePath . $imageNames[array_rand($imageNames)]
                ]);
            });
        }
    }
}
