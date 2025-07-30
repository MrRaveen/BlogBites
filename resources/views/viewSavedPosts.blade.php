<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Saved Blog Posts</h2>

            @forelse($savedPosts as $blog)
                <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/' . $blog->imageURL) }}" class="w-full h-40 object-cover" alt="Blog Image">

                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">{{ $blog->title }}</h3>

                        <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-3">{{ Str::limit(strip_tags($blog->content), 100) }}</p>

                        <div class="mt-3 text-sm">
                            <span class="inline-block px-2 py-1 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">
                                {{ ucfirst($blog->category->categoryName ?? 'Uncategorized') }}
                            </span>
                        </div>

                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('blog.showSingle', $blog->slug) }}" class="text-blue-600 hover:underline">View</a>

                            <div class="flex items-center gap-3">
                                <form method="POST" action="{{ route('blog.like', $blog->blogID) }}">
                                    @csrf
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        ❤️ {{ $blog->likes_count ?? 0 }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 dark:text-gray-300">You haven’t saved any blog posts yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
