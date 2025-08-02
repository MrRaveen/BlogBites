<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>{{ $meta_title ?? 'BlogBites' }}</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $meta_description ?? 'BlogBites is your go-to platform to explore insightful blogs, connect with writers, and discover content tailored to your interests.' }}" />
    <meta name="keywords" content="{{ $meta_keywords ?? 'BlogBites, blogs, writers, community, Laravel blog, blogging platform, latest posts, author follow' }}" />
    <meta name="author" content="BlogBites Team" />
    <meta name="robots" content="index, follow" />

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="{{ $meta_title ?? 'BlogBites — Explore & Engage with Insightful Blogs' }}" />
    <meta property="og:description" content="{{ $meta_description ?? 'BlogBites is your go-to platform to explore insightful blogs, connect with writers, and discover content tailored to your interests.' }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ $meta_og_image ?? asset('images/blogbites-og-image.jpg') }}" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $meta_title ?? 'BlogBites — Explore & Engage with Insightful Blogs' }}" />
    <meta name="twitter:description" content="{{ $meta_description ?? 'BlogBites is your go-to platform to explore insightful blogs, connect with writers, and discover content tailored to your interests.' }}" />
    <meta name="twitter:image" content="{{ $meta_twitter_image ?? asset('images/blogbites-twitter-image.jpg') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-4xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                            <h1 class="text-3xl font-bold text-black dark:text-white">BlogBites</h1>
                        </div>
                        @if (Route::has('login'))
                            <livewire:welcome.navigation />
                        @endif
                    </header>

                    <main class="mt-6">
                        <div class="rounded-lg bg-white p-8 shadow-lg ring-1 ring-black/10 dark:bg-zinc-900 dark:ring-zinc-800">
                            <h2 class="text-2xl font-semibold text-black dark:text-white mb-4">Welcome to BlogBites</h2>
                            <p class="text-base text-black/70 dark:text-white/70 leading-relaxed">
                                BlogBites is your one-stop platform to explore insightful blogs, engage with a vibrant community of writers, and discover content tailored to your interests.
                            </p>
                            <p class="mt-4 text-base text-black/70 dark:text-white/70 leading-relaxed">
                                Whether you're here to read, write, or get inspired, BlogBites makes blogging simple and social. Stay updated with the latest posts, follow your favorite authors, and build your own digital presence.
                            </p>
                            <p class="mt-4 text-base text-black/70 dark:text-white/70 leading-relaxed">
                                Built with Laravel and powered by a clean, modern interface, BlogBites delivers performance, community, and creativity in one beautifully crafted experience.
                            </p>
                        </div>
                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        BlogBites v1.0 • Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
