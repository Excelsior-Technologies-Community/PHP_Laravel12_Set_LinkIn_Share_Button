<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>LinkedIn Share Button - Laravel 12</title>

    <!-- SEO Meta -->
    <meta name="description" content="Laravel 12 LinkedIn Share Button Example">

    <!-- Open Graph Meta (IMPORTANT for LinkedIn preview) -->
    <meta property="og:title" content="Laravel 12 LinkedIn Share">
    <meta property="og:description" content="Learn how to add LinkedIn share button in Laravel 12">
    <meta property="og:image" content="{{ asset('images/share.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Simple Styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .linkedin-btn {
            background: #0077b5;
            color: #fff;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            display: inline-block;
        }

        .linkedin-btn:hover {
            background: #005f8d;
        }
    </style>
</head>

<body>

    <div class="card">
        <h2>Share on LinkedIn</h2>
        <p>Click the button below to share this page on LinkedIn</p>

        <a class="linkedin-btn"
            href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
            target="_blank">
            🔗 Share on LinkedIn
        </a>
    </div>

</body>

</html>