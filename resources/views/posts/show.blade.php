<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post['title'] }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="bg-gray-100">

    <div class="max-w-6xl mx-auto px-5 py-10">

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Back Button -->

        <a href="{{ route('posts.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-8">

            <i class="fas fa-arrow-left mr-2"></i>

            Back to Posts

        </a>

        <!-- Article -->

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">

            <img src="{{ $post['image'] }}" class="w-full h-96 object-cover">

            <div class="p-8">

                <!-- Meta -->

                <div class="flex flex-wrap gap-5 text-gray-500 mb-5">

                    <span>

                        <i class="fas fa-user mr-2"></i>

                        {{ $post['author'] }}

                    </span>

                    <span>

                        <i class="fas fa-calendar mr-2"></i>

                        {{ \Carbon\Carbon::parse($post['published_at'])->format('d M Y') }}

                    </span>

                    <span>

                        <i class="fas fa-clock mr-2"></i>

                        {{ $readingTime }} min read

                    </span>

                </div>

                <!-- Title -->

                <h1 class="text-4xl font-bold mb-6">

                    {{ $post['title'] }}

                </h1>

                <!-- Content -->

                <div class="text-lg leading-9 text-gray-700">

                    {{ $post['content'] }}

                </div>

                <!-- Like + Share -->

                <div class="border-t mt-10 pt-8">

                    <div class="flex flex-wrap gap-4">

                        <!-- Like -->

                        <form action="{{ route('posts.like', $post['id']) }}" method="POST">

                            @csrf

                            <button class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg">

                                ❤️ Like ({{ $likes }})

                            </button>

                        </form>

                        <!-- LinkedIn Share -->

                        <a href="{{ route('posts.share', $post['id']) }}" target="_blank"
                            class="bg-[#0077B5] hover:bg-[#005983] text-white px-6 py-3 rounded-lg">

                            <i class="fab fa-linkedin mr-2"></i>

                            Share ({{ $shares }})

                        </a>

                        <!-- Copy Link -->

                        <button onclick="copyLink()" class="bg-gray-700 hover:bg-black text-white px-6 py-3 rounded-lg">

                            <i class="fas fa-copy mr-2"></i>

                            Copy Link

                        </button>

                    </div>

                </div>

                <!-- Previous / Next -->

                <div class="grid md:grid-cols-2 gap-6 mt-10">

                    <div>

                        @if($previousPost)

                            <a href="{{ route('posts.show', $previousPost['id']) }}"
                                class="block bg-gray-100 hover:bg-gray-200 rounded-xl p-5">

                                <small class="text-gray-500">

                                    Previous Post

                                </small>

                                <h3 class="font-bold mt-2">

                                    {{ $previousPost['title'] }}

                                </h3>

                            </a>

                        @endif

                    </div>

                    <div>

                        @if($nextPost)

                            <a href="{{ route('posts.show', $nextPost['id']) }}"
                                class="block bg-gray-100 hover:bg-gray-200 rounded-xl p-5">

                                <small class="text-gray-500">

                                    Next Post

                                </small>

                                <h3 class="font-bold mt-2">

                                    {{ $nextPost['title'] }}

                                </h3>

                            </a>

                        @endif

                    </div>

                </div>

                <!-- Related Posts -->

                <div class="mt-14">

                    <h2 class="text-2xl font-bold mb-6">

                        Related Posts

                    </h2>

                    <div class="grid md:grid-cols-2 gap-6">

                        @foreach($relatedPosts as $related)

                            <div class="border rounded-xl overflow-hidden shadow">

                                <img src="{{ $related['image'] }}" class="w-full h-48 object-cover">

                                <div class="p-5">

                                    <h3 class="font-bold text-lg">

                                        {{ $related['title'] }}

                                    </h3>

                                    <p class="text-gray-500 mt-3">

                                        {{ Str::limit($related['content'], 100) }}

                                    </p>

                                    <a href="{{ route('posts.show', $related['id']) }}"
                                        class="inline-block mt-4 text-blue-600 font-semibold">

                                        Read More →

                                    </a>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>
        </div>

        <!-- Footer -->
        <div class="mt-10 bg-white rounded-xl shadow p-6 text-center">

            <h3 class="text-xl font-bold text-gray-800">
                Laravel 12 LinkedIn Share Demo
            </h3>

            <p class="text-gray-500 mt-2">
                Demonstration of LinkedIn sharing, likes, reading time,
                related posts, previous/next navigation and copy link.
            </p>

        </div>

    </div>

    <!-- Toast -->
    <div id="toast" class="hidden fixed bottom-6 right-6 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg">

        Link Copied Successfully!

    </div>

    <script>

        function copyLink() {

            navigator.clipboard.writeText(window.location.href);

            let toast = document.getElementById('toast');

            toast.classList.remove('hidden');

            setTimeout(function () {

                toast.classList.add('hidden');

            }, 2000);

        }

    </script>

</body>

</html>