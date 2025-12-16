## PHP_Laravel12_Set_LinkIn_Share_Button

A simple and clean implementation to add a LinkedIn Share Button to a Laravel 12 website. No LinkedIn API key or SDK is required.

## Features

Simple text-based LinkedIn share link

No icon, no JavaScript, no SDK

Uses official LinkedIn share URL

Supports Open Graph preview (title, image, description)

Works with Laravel 12, 11, 10

## Step 1: Create Route

## routes/web.php

use Illuminate\Support\Facades\Route;


Route::get('/linkedin-share', function () {
    return view('linkedin-share');
});

## Step 2: Create Blade View

## resources/views/linkedin-share.blade.php

<!DOCTYPE html>
<html>
<head>
    <title>LinkedIn Share - Laravel 12</title>


    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Laravel 12 LinkedIn Share">
    <meta property="og:description" content="Add LinkedIn share button in Laravel 12">
    <meta property="og:image" content="{{ asset('images/share.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
</head>
<body>


    <h2>Share This Page</h2>


    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
       target="_blank">
        Share on LinkedIn
    </a>


</body>
</html>

## Step 3: Add Preview Image (Optional)

## public/images/share.png

Recommended size:

1200 x 630 px

## Step 4: Clear Cache

php artisan optimize:clear

## Step 5: Run Project
php artisan serve

## Open in browser:

http://127.0.0.1:8000/linkedin-share

## screenshot

## 1. <img width="735" height="457" alt="image" src="https://github.com/user-attachments/assets/48bb599d-d444-4ab2-b167-ea8a0dda5e4f" />
