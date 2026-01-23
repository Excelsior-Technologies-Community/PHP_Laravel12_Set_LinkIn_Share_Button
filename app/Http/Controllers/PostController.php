<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // Display list of posts
    public function index()
    {
        $posts = [
            [
                'id' => 1,
                'title' => 'Getting Started with Laravel 12',
                'content' => 'Laravel 12 introduces exciting new features...',
                'author' => 'John Doe',
                'published_at' => '2024-01-15'
            ],
            [
                'id' => 2,
                'title' => 'Mastering Blade Templates',
                'content' => 'Blade is Laravel\'s powerful templating engine...',
                'author' => 'Jane Smith',
                'published_at' => '2024-01-20'
            ],
            [
                'id' => 3,
                'title' => 'Building APIs with Laravel',
                'content' => 'Learn how to create robust RESTful APIs...',
                'author' => 'Mike Johnson',
                'published_at' => '2024-01-25'
            ],
        ];

        return view('posts.index', compact('posts'));
    }

    // Display single post
    public function show($id)
    {
        $posts = [
            1 => [
                'id' => 1,
                'title' => 'Getting Started with Laravel 12',
                'content' => 'Laravel 12 introduces exciting new features including improved performance, new artisan commands, and enhanced security features. In this tutorial, we will explore how to get started with the latest version of Laravel.',
                'author' => 'John Doe',
                'published_at' => '2024-01-15',
                'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=400'
            ],
            2 => [
                'id' => 2,
                'title' => 'Mastering Blade Templates',
                'content' => 'Blade is Laravel\'s powerful templating engine that provides convenient shortcuts for common PHP control structures. Learn how to use template inheritance, components, and directives to create dynamic views.',
                'author' => 'Jane Smith',
                'published_at' => '2024-01-20',
                'image' => 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w-400'
            ],
            3 => [
                'id' => 3,
                'title' => 'Building APIs with Laravel',
                'content' => 'Learn how to create robust RESTful APIs with Laravel. We\'ll cover authentication, rate limiting, API resources, and testing strategies to build production-ready APIs.',
                'author' => 'Mike Johnson',
                'published_at' => '2024-01-25',
                'image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w-400'
            ],
        ];

        if (!isset($posts[$id])) {
            abort(404);
        }

        $post = $posts[$id];
        return view('posts.show', compact('post'));
    }
}