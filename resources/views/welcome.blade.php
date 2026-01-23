<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel LinkedIn Share Demo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen">
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Header -->
            <div class="mb-12">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-600 rounded-full mb-6">
                    <i class="fab fa-linkedin text-white text-3xl"></i>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    LinkedIn Share Integration
                </h1>
                <p class="text-xl text-gray-600 mb-8">
                    Learn how to add LinkedIn share buttons in Laravel 12
                </p>
            </div>
            
            <!-- Features -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <div class="text-blue-600 mb-4">
                        <i class="fas fa-code text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Three Methods</h3>
                    <p class="text-gray-600">Learn simple URL, SDK, and custom JavaScript approaches</p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <div class="text-blue-600 mb-4">
                        <i class="fas fa-mobile-alt text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Responsive Design</h3>
                    <p class="text-gray-600">Works perfectly on all devices and screen sizes</p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <div class="text-blue-600 mb-4">
                        <i class="fas fa-share-alt text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Easy Integration</h3>
                    <p class="text-gray-600">Copy-paste ready code for your Laravel projects</p>
                </div>
            </div>
            
            <!-- Demo Link -->
            <div class="bg-white rounded-xl shadow-xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">View Demo</h2>
                <p class="text-gray-600 mb-8">
                    Click the button below to see live examples of LinkedIn share buttons in action. 
                    You'll find three different implementation methods with explanations.
                </p>
                <a href="{{ route('posts.index') }}" 
                   class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-lg text-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-rocket mr-3"></i>
                    Launch Demo Blog
                </a>
            </div>
            
            <!-- Instructions -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-8 text-left">
                <h3 class="text-2xl font-bold text-blue-800 mb-6">How It Works</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <span class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold mr-3">1</span>
                        <p class="text-blue-700">Click "Launch Demo Blog" to view sample blog posts</p>
                    </div>
                    <div class="flex items-start">
                        <span class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold mr-3">2</span>
                        <p class="text-blue-700">Select any post to read its content</p>
                    </div>
                    <div class="flex items-start">
                        <span class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold mr-3">3</span>
                        <p class="text-blue-700">Try all three LinkedIn share button methods at the bottom</p>
                    </div>
                    <div class="flex items-start">
                        <span class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold mr-3">4</span>
                        <p class="text-blue-700">Copy the code to implement in your own projects</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>