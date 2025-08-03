<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- FIXME: test --}}
        {{-- SEO Metadata --}}
    <title>@yield('title', 'My Blog Platform')</title>
    <meta name="description" content="@yield('meta_description', 'Welcome to our Laravel blog platform. Read and share high-quality blogs written by our community.')">
    <meta name="keywords" content="@yield('meta_keywords', 'laravel, blog, platform, posts, reading, writing')">
    <meta name="author" content="@yield('meta_author', 'My Blog Platform')">

    {{-- Open Graph / Facebook --}}
    <meta property="og:title" content="@yield('og_title', 'My Blog Platform')" />
    <meta property="og:description" content="@yield('og_description', 'Explore and share blogs written by the community.')" />
    <meta property="og:image" content="@yield('og_image', asset('images/default-og.png'))" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="@yield('og_type', 'website')" />

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('twitter_title', 'My Blog Platform')" />
    <meta name="twitter:description" content="@yield('twitter_description', 'Read the best blogs from our writers.')" />
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/default-twitter.png'))" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @stack('scripts')
    </body>
</html>
