<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel 12 - LinkedIn Share</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap (optional, for style) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="mb-3">🔗 Share on LinkedIn</h3>

        <p>
            This is a simple Laravel 12 project to share a page on LinkedIn.
        </p>

        @php
            $shareUrl = urlencode(url()->current());
            $title = urlencode("Laravel 12 LinkedIn Share Button Demo");
        @endphp

        <!-- LinkedIn Share Button -->
        <a 
            href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}"
            target="_blank"
            class="btn btn-primary"
        >
            Share on LinkedIn
        </a>
    </div>
</div>

</body>
</html>
