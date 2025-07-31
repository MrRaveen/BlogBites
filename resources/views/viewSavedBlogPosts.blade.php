<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-8 text-gray-900 dark:text-white">Saved Blog Posts</h2><br>

            @forelse($savedPosts as $blog)
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden mb-6">
                    {{-- Blog Image --}}
                    @if($blog->imageURL)
                        <img src="{{ asset('storage/' . $blog->imageURL) }}" class="w-full h-64 object-cover" alt="Blog image">
                    @endif

                    {{-- Blog Details --}}
                    <div class="p-6">
                        <div class="mb-2 text-sm text-gray-600 dark:text-gray-400">
                            By {{ $blog->owner->userName ?? 'Unknown' }} •
                            {{ \Carbon\Carbon::parse($blog->lastUpdatedDate)->format('M d, Y') }} •
                            <span class="text-xs bg-gray-300 dark:bg-gray-700 px-2 py-1 rounded">
                                {{ ucfirst($blog->category->categoryName ?? 'Uncategorized') }}
                            </span>
                        </div>

                        <h3 class="text-2xl font-semibold text-gray-800 dark:text-white">
                            <a href="{{ route('showSingleBlogsEndpoint', $blog->slug) }}" class="hover:underline">
                                {{ $blog->title }}
                            </a>
                        </h3>

                        {{-- Tags --}}
                        <div class="mt-2 mb-4">
                            @foreach($blog->tags as $tag)
                                <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full mr-2">
                                    #{{ $tag->tagName }}
                                </span>
                            @endforeach
                        </div>

                        {{-- Like Count
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            ❤️ {{ $blog->likes->count() }} Likes
                        </div> --}}
                        {{-- Like Count & Unsave --}}
<div class="flex items-center justify-between mt-4">
    <div class="text-sm text-gray-600 dark:text-gray-400">
        ❤️ {{ $blog->likes->count() }} Likes
    </div>

    <form method="POST" action="{{ route('blog.unsave', $blog->blogID) }}">
        @csrf
        @method('DELETE')
        <button type="submit"
            class="text-red-600 hover:text-red-800 text-sm font-semibold">
            Remove from Saved
        </button>
    </form>
</div>

                    </div>
                </div>
            @empty
                <div class="text-gray-600 dark:text-gray-300">
                    You haven't saved any blogs yet.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
