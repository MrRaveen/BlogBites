<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-semibold text-gray-900 dark:text-white mb-6">Latest Blog Posts</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($blogs as $blog)
                    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md overflow-hidden">
                        <img src="{{ asset('storage/' . $blog->imageURL) }}" class="w-full h-40 object-cover" alt="Blog Image">

                        <div class="p-4">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-1">{{ $blog->title }}</h3>

                            <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-3">
                                {{ Str::limit(strip_tags($blog->content), 100) }}
                            </p>

                            <div class="mt-2 text-xs text-gray-500">
                                Category: {{ $blog->category->categoryName }} |
                                By: {{ $blog->owner->userName }}
                            </div>

                            <div class="mt-3 flex justify-between items-center">
                                <a href="{{ route('showSingleBlogsEndpoint', $blog->slug) }}" class="text-blue-600 hover:underline text-sm">View Full</a>

                                <div class="flex items-center gap-2 text-sm">
                                    @php
                                        $isLiked = in_array($blog->blogID, $likedBlogIDs ?? []);
                                    @endphp
                                    <form method="POST" action="{{ route('blog.DashboardLike', $blog->blogID) }}">
                                        @csrf
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            {{ $isLiked ? '💖' : '🤍' }} {{ $blog->likes_count }}
                                        </button>
                                    </form>
                                    <span class="text-gray-500">💬 {{ $blog->comments_count }}</span>
                                </div>
                            </div>

                            {{-- Comment Form --}}
                            <form method="POST" action="{{ route('blog.comment', $blog->blogID) }}" class="mt-3">
                                @csrf
                                <textarea name="commentDescription" class="w-full p-2 rounded text-sm dark:bg-gray-800 dark:text-white" placeholder="Write a comment..." rows="2" required></textarea>
                                <x-primary-button class="mt-2">Comment</x-primary-button>
                            </form>

                            {{-- Show Last 2 Comments --}}
                            @foreach($blog->comments->take(2) as $comment)
    <div class="mt-2 text-sm text-gray-800 dark:text-gray-200 flex justify-between items-center">
        <div>
            <strong>{{ $comment->user->userName }}:</strong> {{ $comment->commentDescription }}
        </div>

        @if(Auth::id() === $comment->userID)
            <form method="POST" action="{{ route('blog.comment.delete', $comment->commentID) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-xs text-red-500 ml-2 hover:underline">🗑️</button>
            </form>
        @endif
    </div>
@endforeach

                        </div>
                    </div>
                @empty
                    <p class="text-gray-700 dark:text-gray-300 text-center col-span-full">No blogs posted yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
