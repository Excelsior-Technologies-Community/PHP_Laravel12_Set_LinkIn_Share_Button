<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
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