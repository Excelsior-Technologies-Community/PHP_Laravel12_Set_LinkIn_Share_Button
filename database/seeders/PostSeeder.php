<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::insert([

            [
                'title' => 'Getting Started with Laravel 12',

                'content' => 'Laravel 12 introduces exciting new features including improved performance, new artisan commands, enhanced security features, routing improvements, Blade enhancements, middleware updates, authentication improvements and more. This guide helps beginners start building amazing applications using Laravel.',

                'author' => 'John Doe',

                'published_at' => '2024-01-15',

                'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800',

                'created_at' => now(),

                'updated_at' => now(),
            ],

            [
                'title' => 'Mastering Blade Templates',

                'content' => 'Blade is Laravel\'s powerful templating engine. Learn layouts, sections, components, slots, directives, loops, conditions, template inheritance and reusable UI components for professional Laravel applications.',

                'author' => 'Jane Smith',

                'published_at' => '2024-01-20',

                'image' => 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=800',

                'created_at' => now(),

                'updated_at' => now(),
            ],

            [
                'title' => 'Building APIs with Laravel',

                'content' => 'Build secure REST APIs using Laravel. Learn authentication, Sanctum, API Resources, Validation, Pagination, Rate Limiting and testing APIs for production ready applications.',

                'author' => 'Mike Johnson',

                'published_at' => '2024-01-25',

                'image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800',

                'created_at' => now(),

                'updated_at' => now(),
            ],

        ]);
    }
}