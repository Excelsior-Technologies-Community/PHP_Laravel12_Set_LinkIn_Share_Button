<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Blog Posts</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $post['title'] }}</h2>
                    <p class="text-gray-600 mb-4">{{ Str::limit($post['content'], 100) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">By {{ $post['author'] }}</span>
                        <a href="{{ route('posts.show', $post['id']) }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-300">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>