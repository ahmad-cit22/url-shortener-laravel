<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URLShort</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    @include('includes.styles')
</head>

<body class="min-h-screen flex flex-col justify-between">

    <!-- Header -->
    @include('partials.header')

    <!-- Flash Messages -->
    @include('partials.notifications')

    <!-- Main Section -->
    @yield('content')

    <!-- Modals -->
    @stack('modals')

    <!-- Footer -->
    @include('partials.footer')

    @include('includes.scripts')
</body>
</html>
