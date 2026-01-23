<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post['title'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- LinkedIn Platform JavaScript SDK -->
    <script src="https://platform.linkedin.com/in.js" type="text/javascript">
        lang: en_US
    </script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Back button -->
        <a href="{{ route('posts.index') }}" 
           class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6">
            <i class="fas fa-arrow-left mr-2"></i> Back to Posts
        </a>
        
        <!-- Post Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            @if(isset($post['image']))
            <div class="h-64 overflow-hidden">
                <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover">
            </div>
            @endif
            
            <div class="p-8">
                <!-- Post Meta -->
                <div class="flex justify-between items-center mb-4">
                    <div class="text-sm text-gray-500">
                        <span class="font-medium">{{ $post['author'] }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ \Carbon\Carbon::parse($post['published_at'])->format('F d, Y') }}</span>
                    </div>
                </div>
                
                <!-- Post Title -->
                <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ $post['title'] }}</h1>
                
                <!-- Post Content -->
                <div class="prose max-w-none mb-8">
                    <p class="text-gray-700 text-lg leading-relaxed">{{ $post['content'] }}</p>
                </div>
                
                <!-- Share Section -->
                <div class="border-t border-gray-200 pt-6 mt-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Share this post</h3>
                    
                    <div class="flex flex-wrap gap-4">
                        <!-- Method 1: Simple Share Button (Direct URL) -->
                        <div class="share-method">
                            <h4 class="font-medium text-gray-700 mb-2">Method 1: Simple Share Button</h4>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('posts.show', $post['id'])) }}"
                               target="_blank"
                               class="inline-flex items-center bg-[#0077B5] hover:bg-[#005983] text-white px-5 py-2 rounded-lg font-medium transition-colors duration-300">
                                <i class="fab fa-linkedin mr-2"></i>
                                Share on LinkedIn
                            </a>
                            <p class="text-sm text-gray-500 mt-1">Direct link method - opens in new tab</p>
                        </div>
                        
                        <!-- Method 2: LinkedIn SDK Share Button -->
                        <div class="share-method mt-4">
                            <h4 class="font-medium text-gray-700 mb-2">Method 2: SDK Share Button</h4>
                            <script type="IN/Share" 
                                    data-url="{{ route('posts.show', $post['id']) }}"
                                    data-counter="right">
                            </script>
                            <p class="text-sm text-gray-500 mt-1">Official LinkedIn SDK with counter</p>
                        </div>
                        
                        <!-- Method 3: Custom Share with Preview -->
                        <div class="share-method mt-4">
                            <h4 class="font-medium text-gray-700 mb-2">Method 3: Custom Share Button</h4>
                            <button onclick="shareOnLinkedIn()"
                                    class="inline-flex items-center bg-[#0077B5] hover:bg-[#005983] text-white px-5 py-2 rounded-lg font-medium transition-colors duration-300">
                                <i class="fab fa-linkedin mr-2"></i>
                                Share with Custom Options
                            </button>
                            <p class="text-sm text-gray-500 mt-1">Customizable sharing with preview</p>
                        </div>
                    </div>
                </div>
                
                <!-- Share Instructions -->
                <div class="mt-10 bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-blue-800 mb-3">About LinkedIn Sharing</h3>
                    <div class="space-y-3 text-blue-700">
                        <p><strong>Method 1:</strong> Simple URL method - works without JavaScript, opens LinkedIn's share dialog in a new window.</p>
                        <p><strong>Method 2:</strong> Official LinkedIn SDK - provides more features like share counters, but requires LinkedIn's script.</p>
                        <p><strong>Method 3:</strong> Custom JavaScript method - gives you full control over the sharing experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom JavaScript for LinkedIn Sharing -->
    <script>
        // Method 3: Custom LinkedIn Share Function
        function shareOnLinkedIn() {
            const postUrl = "{{ route('posts.show', $post['id']) }}";
            const postTitle = "{{ $post['title'] }}";
            const postSummary = "{{ Str::limit($post['content'], 200) }}";
            const postSource = "{{ config('app.name', 'Laravel Blog') }}";
            
            // LinkedIn Share URL
            const linkedInShareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(postUrl)}`;
            
            // Open in a popup window
            const width = 600;
            const height = 400;
            const left = (window.screen.width - width) / 2;
            const top = (window.screen.height - height) / 2;
            
            window.open(
                linkedInShareUrl,
                'LinkedIn Share',
                `width=${width},height=${height},left=${left},top=${top},toolbar=0,status=0`
            );
            
            // Optional: Track the share event
            console.log('Shared on LinkedIn:', {
                url: postUrl,
                title: postTitle,
                source: postSource
            });
        }
        
        // Initialize LinkedIn SDK when it's loaded
        function initLinkedInSDK() {
            if (window.IN && window.IN.parse) {
                window.IN.parse();
            }
        }
        
        // Call initialization when page loads
        document.addEventListener('DOMContentLoaded', initLinkedInSDK);
        
        // Re-parse when dynamic content loads (if needed)
        if (window.IN && window.IN.parse) {
            window.IN.parse();
        }
    </script>
</body>
</html>