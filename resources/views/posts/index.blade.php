<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laravel Blog Posts</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto px-5 py-10">

        <!-- Header -->
        <div class="text-center mb-10">

            <h1 class="text-4xl font-bold text-gray-800">
                Laravel 12 Blog Dashboard
            </h1>

            <p class="text-gray-500 mt-3">
                Search posts, read articles and share them on LinkedIn.
            </p>

        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

            <div class="bg-white rounded-xl shadow p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-500 text-sm">
                            Total Posts
                        </p>

                        <h2 class="text-3xl font-bold mt-2">
                            {{ $stats['totalPosts'] }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center">

                        <i class="fas fa-newspaper text-blue-600 text-2xl"></i>

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-xl shadow p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-500 text-sm">
                            Authors
                        </p>

                        <h2 class="text-3xl font-bold mt-2">
                            {{ $stats['totalAuthors'] }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center">

                        <i class="fas fa-users text-green-600 text-2xl"></i>

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-xl shadow p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-500 text-sm">
                            Today's Posts
                        </p>

                        <h2 class="text-3xl font-bold mt-2">
                            {{ $stats['todayPosts'] }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-full bg-yellow-100 flex items-center justify-center">

                        <i class="fas fa-calendar-day text-yellow-600 text-2xl"></i>

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-xl shadow p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-500 text-sm">
                            Total Shares
                        </p>

                        <h2 class="text-3xl font-bold mt-2">
                            {{ $stats['totalShares'] }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center">

                        <i class="fab fa-linkedin text-indigo-600 text-2xl"></i>

                    </div>

                </div>

            </div>

        </div>

        <!-- Search -->

        <div class="bg-white rounded-xl shadow p-6 mb-8">

            <form method="GET" action="{{ route('posts.index') }}">

                <div class="flex flex-col md:flex-row gap-4">

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search title, author or content..."
                        class="flex-1 border rounded-lg px-5 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                        <i class="fas fa-search mr-2"></i>

                        Search

                    </button>

                    <a href="{{ route('posts.index') }}"
                        class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg text-center">

                        Reset

                    </a>

                </div>

            </form>

        </div>

        <!-- Blog Cards -->

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($posts as $post)

                <div class="bg-white rounded-xl shadow hover:shadow-xl transition duration-300 overflow-hidden">

                    <img src="{{ $post['image'] }}" class="w-full h-52 object-cover">

                    <div class="p-6">

                        <h2 class="text-2xl font-bold text-gray-800 mb-3">

                            {{ $post['title'] }}

                        </h2>

                        <p class="text-gray-600 mb-5">

                            {{ Str::limit($post['content'], 120) }}

                        </p>

                        <div class="flex justify-between text-sm text-gray-500 mb-5">

                            <span>

                                <i class="fas fa-user mr-1"></i>

                                {{ $post['author'] }}

                            </span>

                            <span>

                                <i class="fas fa-calendar mr-1"></i>

                                {{ \Carbon\Carbon::parse($post['published_at'])->format('d M Y') }}

                            </span>

                        </div>

                        <a href="{{ route('posts.show', $post['id']) }}"
                            class="block w-full bg-blue-600 hover:bg-blue-700 text-center text-white py-3 rounded-lg">

                            Read Full Article

                        </a>

                    </div>

                </div>

            @empty

                <div class="col-span-3">

                    <div class="bg-white rounded-xl shadow p-10 text-center">

                        <i class="fas fa-folder-open text-6xl text-gray-300 mb-4"></i>

                        <h2 class="text-2xl font-bold text-gray-700">
                            No Posts Found
                        </h2>

                        <p class="text-gray-500 mt-3">
                            No blog posts matched your search.
                        </p>

                        <a href="{{ route('posts.index') }}"
                            class="inline-block mt-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
                            Show All Posts
                        </a>

                    </div>

                </div>

            @endforelse

        </div>

        <!-- Footer -->

        <div class="mt-14">

            <div class="bg-white rounded-xl shadow p-6">

                <div class="flex flex-col md:flex-row justify-between items-center">

                    <div>

                        <h3 class="text-xl font-bold text-gray-800">
                            Laravel 12 LinkedIn Share Demo
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Professional Laravel demo with Search, Statistics,
                            Reading Time, Likes, Related Posts and LinkedIn Sharing.
                        </p>

                    </div>

                    <div class="flex gap-4 mt-5 md:mt-0">

                        <a href="https://linkedin.com" target="_blank"
                            class="w-12 h-12 rounded-full bg-blue-700 text-white flex items-center justify-center hover:scale-110 transition">

                            <i class="fab fa-linkedin"></i>

                        </a>

                        <a href="https://github.com" target="_blank"
                            class="w-12 h-12 rounded-full bg-gray-800 text-white flex items-center justify-center hover:scale-110 transition">

                            <i class="fab fa-github"></i>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>