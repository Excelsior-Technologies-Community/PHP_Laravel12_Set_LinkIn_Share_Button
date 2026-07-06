<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post['title'] }}</title>
    <!-- Open Graph for LinkedIn -->
    <meta property="og:title" content="{{ $post['title'] }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($post['content']), 150) }}">
    <meta property="og:image" content="{{ $post['image'] }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="bg-gray-100">

    <div class="max-w-6xl mx-auto px-5 py-10 animate-page">

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

                        <button
                            onclick="openShareModal()"
                            class="bg-[#0077B5] hover:bg-[#005983] text-white px-6 py-3 rounded-lg">

                            <i class="fab fa-linkedin mr-2"></i>

                            Share ({{ $shares }})

                        </button>

                        <!-- Copy Link -->

                        <button onclick="copyLink()" class="bg-gray-700 hover:bg-black text-white px-6 py-3 rounded-lg">

                            <i class="fas fa-copy mr-2"></i>

                            Copy Link

                        </button>

                        <button
                            onclick="openQrModal()"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition duration-300">

                            <i class="fas fa-qrcode mr-2"></i>

                            Generate QR

                        </button>

                        <!-- Share Anywhere -->
                        <button
                            onclick="nativeShare()"
                            class="bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white px-6 py-3 rounded-lg transition duration-300 hover:scale-105">

                            <i class="fas fa-share-alt mr-2"></i>

                            Share Anywhere
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
    <div id="toast"
        class="hidden fixed bottom-6 right-6 bg-green-600 text-white px-6 py-4 rounded-xl shadow-xl z-50">

        <div class="flex items-center">

            <i class="fas fa-check-circle mr-3 text-xl"></i>

            Link copied successfully!

        </div>

    </div>

    <!-- QR Code Modal -->

    <div
        id="qrModal"
        class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">

        <div
            class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-5 overflow-hidden">

            <!-- Header -->

            <div class="bg-green-600 text-white px-6 py-4 flex justify-between items-center">

                <h2 class="text-xl font-bold">

                    QR Code Share

                </h2>

                <button
                    onclick="closeQrModal()"
                    class="text-3xl leading-none">

                    &times;

                </button>

            </div>

            <!-- Body -->

            <div class="p-8 text-center">

                <img
                    id="qrImage"
                    class="mx-auto border rounded-lg p-2 bg-white w-64 h-64"
                    alt="QR Code">

                <p class="text-gray-600 mt-6">

                    Scan this QR code with your phone to open this blog post.

                </p>

                <a
                    id="downloadQr"
                    download="linkedin-post-qr.png"
                    class="inline-block mt-8 bg-green-600 hover:bg-green-700 hover:scale-105 transition duration-300 text-white px-6 py-3 rounded-lg">

                    <i class="fas fa-download mr-2"></i>

                    Download QR

                </a>

            </div>

        </div>

    </div>

    <!-- LinkedIn Share Preview Modal -->

    <div id="shareModal"
        class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

        <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-xl transition-all duration-300 hover:-translate-y-1">

            <!-- Header -->
            <div class="bg-[#0077B5] text-white px-6 py-4 flex justify-between items-center">

                <div class="flex items-center">
                    <i class="fab fa-linkedin text-3xl mr-3"></i>
                    <h2 class="text-xl font-bold">LinkedIn Share Preview</h2>
                </div>

                <button onclick="closeShareModal()" class="text-3xl">&times;</button>

            </div>

            <!-- Image -->
            <img src="{{ $post['image'] }}" class="w-full h-64 object-cover">

            <!-- Body -->
            <div class="p-6">

                <h2 class="text-2xl font-bold">{{ $post['title'] }}</h2>

                <div class="flex items-center gap-4 mt-3 text-sm text-gray-500">

                    <span class="flex items-center">
                        <i class="fas fa-clock mr-2 text-blue-600"></i>
                        {{ ceil(str_word_count($post['content']) / 200) }} min read
                    </span>

                    <span class="flex items-center">
                        <i class="fas fa-user mr-2 text-green-600"></i>
                        {{ $post['author'] }}
                    </span>

                </div>

                <p class="text-gray-600 mt-4">
                    {{ Str::limit($post['content'],180) }}
                </p>

                <!-- Technology Badges -->
                <div class="flex flex-wrap gap-2 mt-4">

                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                        Laravel 12
                    </span>

                    <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-semibold">
                        LinkedIn
                    </span>

                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                        Blog
                    </span>

                </div>

                <div class="mt-6 border rounded-lg p-4 bg-gray-50">

                    <p class="text-gray-400 text-sm">Link Preview</p>

                    <p class="text-blue-600 break-all">
                        {{ route('posts.show',$post['id']) }}
                    </p>

                </div>

                <div class="flex justify-end gap-3 mt-8">

                    <button onclick="closeShareModal()"
                        class="px-6 py-3 bg-gray-200 hover:bg-gray-300 hover:scale-105 transition duration-300 rounded-lg">
                        Cancel
                    </button>

                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('posts.show',$post['id'])) }}"
                        target="_blank"
                        class="bg-[#0077B5] hover:bg-[#005983] hover:scale-105 transition duration-300 text-white px-6 py-3 rounded-lg">

                        <i class="fab fa-linkedin mr-2"></i>
                        Share Now
                    </a>

                </div>

            </div>
        </div>
    </div>

    <style>
        @keyframes popup {
            from {
                opacity: 0;
                transform: scale(.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        #qrModal>div {
            animation: popup .25s ease;
        }

        @keyframes fadeInUp {

            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }

        .animate-page {
            animation: fadeInUp .5s ease;
        }
    </style>

    <script>
        function copyLink() {
            navigator.clipboard.writeText(window.location.href);

            let toast = document.getElementById("toast");

            toast.classList.remove("hidden");

            setTimeout(function() {

                toast.classList.add("hidden");

            }, 2500);
        }

        function openQrModal() {
            const pageUrl = "{{ url()->current() }}";

            const qrCode =
                "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" +
                encodeURIComponent(pageUrl);

            document.getElementById("qrImage").src = qrCode;

            document.getElementById("downloadQr").href = qrCode;

            const modal = document.getElementById("qrModal");

            modal.classList.remove("hidden");

            modal.classList.add("flex");
        }

        function closeQrModal() {
            const modal = document.getElementById("qrModal");

            modal.classList.remove("flex");

            modal.classList.add("hidden");
        }

        window.addEventListener("click", function(e) {
            const modal = document.getElementById("qrModal");

            if (e.target === modal) {
                closeQrModal();
            }
        });

        function openShareModal() {
            const modal = document.getElementById("shareModal");
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        }

        function closeShareModal() {
            const modal = document.getElementById("shareModal");
            modal.classList.remove("flex");
            modal.classList.add("hidden");
        }

        window.addEventListener("click", function(e) {
            const modal = document.getElementById("shareModal");

            if (e.target === modal) {
                closeShareModal();
            }
        });

        async function nativeShare() {
            const shareData = {

                title: "{{ $post['title'] }}",

                text: "{{ Str::limit(strip_tags($post['content']),120) }}",

                url: window.location.href
            };

            if (navigator.share) {
                try {
                    await navigator.share(shareData);

                    showToast("Content shared successfully!", "success");
                } catch (error) {
                    console.log(error);
                }
            } else {
                copyLink();

                showToast("Sharing not supported. Link copied instead.", "info");
            }
        }

        function showToast(message, type = "success") {
            let toast = document.getElementById("toast");

            toast.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${
                type === "success"
                ? "fa-check-circle"
                : "fa-info-circle"
            } mr-3 text-xl"></i>

            ${message}
        </div>
    `;

            toast.classList.remove("hidden");

            setTimeout(() => {
                toast.classList.add("hidden");
            }, 2500);
        }
    </script>

</body>

</html>