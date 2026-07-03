<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Blog Posts
     */
    private function getPosts()
    {
        return [
            [
                'id' => 1,
                'title' => 'Getting Started with Laravel 12',
                'content' => 'Laravel 12 introduces exciting new features including improved performance, new artisan commands, enhanced security features, routing improvements, Blade enhancements, middleware updates, authentication improvements and more. This guide helps beginners start building amazing applications using Laravel.',
                'author' => 'John Doe',
                'published_at' => '2024-01-15',
                'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800'
            ],

            [
                'id' => 2,
                'title' => 'Mastering Blade Templates',
                'content' => 'Blade is Laravel\'s powerful templating engine. Learn layouts, sections, components, slots, directives, loops, conditions, template inheritance and reusable UI components for professional Laravel applications.',
                'author' => 'Jane Smith',
                'published_at' => '2024-01-20',
                'image' => 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=800'
            ],

            [
                'id' => 3,
                'title' => 'Building APIs with Laravel',
                'content' => 'Build secure REST APIs using Laravel. Learn authentication, Sanctum, API Resources, Validation, Pagination, Rate Limiting and testing APIs for production ready applications.',
                'author' => 'Mike Johnson',
                'published_at' => '2024-01-25',
                'image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800'
            ],
        ];
    }

    /**
     * Blog Listing
     */
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('author', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');

            });
        }

        $posts = $query->oldest()->get();

        $stats = [
            'totalPosts' => Post::count(),
            'totalAuthors' => Post::distinct('author')->count(),
            'todayPosts' => Post::whereDate('created_at', today())->count(),
            'totalShares' => session('share_count', 0),
        ];

        return view('posts.index', compact('posts', 'stats'));
    }

    /**
     * Single Post
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $readingTime = ceil(str_word_count($post->content) / 200);

        $relatedPosts = Post::where('id', '!=', $id)
            ->latest()
            ->take(2)
            ->get();

        $previousPost = Post::where('id', '<', $id)
            ->latest('id')
            ->first();

        $nextPost = Post::where('id', '>', $id)
            ->oldest('id')
            ->first();

        $likes = session("likes.$id", 0);

        $shares = session("shares.$id", 0);

        return view('posts.show', compact(
            'post',
            'readingTime',
            'relatedPosts',
            'previousPost',
            'nextPost',
            'likes',
            'shares'
        ));
    }

    /**
     * Like Post
     */
    public function like($id)
    {
        $likes = session("likes.$id", 0);

        session(["likes.$id" => $likes + 1]);

        return back()->with('success', 'Post liked successfully.');
    }

    /**
     * Share Counter
     */
    public function share($id)
    {
        $shares = session("shares.$id", 0);

        session(["shares.$id" => $shares + 1]);

        session([
            'share_count' => session('share_count', 0) + 1
        ]);

        return redirect()->away(
            "https://www.linkedin.com/sharing/share-offsite/?url=" .
            urlencode(route('posts.show', $id))
        );
    }
}