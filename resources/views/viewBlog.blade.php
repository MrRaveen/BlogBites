<x-app-layout>
<div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Blog Card --}}
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                {{-- Image --}}
                @if($blog->imageURL)
                    <img src="{{ asset('storage/' . $blog->imageURL) }}" class="w-full h-64 object-cover" alt="Blog image">
                @endif

                <div class="p-6">
                    {{-- Title --}}
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                        {{ $blog->title }}
                    </h1>

                    {{-- Author & Metadata --}}
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-300 mb-4">
                        <span>By {{ $blog->owner->userName ?? 'Unknown' }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $blog->created_at->format('M d, Y') }}</span>
                        <span class="mx-2">•</span>
                        <span class="text-xs px-2 py-1 bg-gray-200 dark:bg-gray-700 rounded">
                            {{ ucfirst($blog->category->categoryName ?? 'Uncategorized') }}
                        </span>
                    </div>

                    {{-- Tags --}}
                    <div class="mb-4">
                        @foreach($blog->tags as $tag)
                            <span class="inline-block bg-indigo-200 text-indigo-800 text-xs px-2 py-1 rounded-full mr-2">
                                #{{ $tag->tagName }}
                            </span>
                        @endforeach
                    </div>

                    {{-- Content --}}
                    <div class="prose dark:prose-invert max-w-none">
                        {!! $blog->content !!}
                    </div>

                    {{-- Likes & Save --}}
                    <div class="flex justify-between items-center mt-6">
                        <form method="POST" action="{{ route('blog.like', $blog->id) }}">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                ❤️ Like ({{ $blog->likes_count ?? 0 }})
                            </button>
                        </form>

                        <form method="POST" action="{{ route('blog.save', $blog->id) }}">
                            @csrf
                            <button type="submit" class="text-blue-500 hover:text-blue-700">
                                💾 Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Comments Section --}}
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 mt-6">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Comments</h2>

                {{-- Comments --}}
                @forelse($blog->comments as $comment)
                    <div class="mb-4 border-b border-gray-200 dark:border-gray-700 pb-4">
                        <div class="text-sm text-gray-700 dark:text-gray-300">
                            <strong>{{ $comment->user->userName ?? 'Anonymous' }}</strong>
                            <span class="ml-2 text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-900 dark:text-white mt-2">
                            {{ $comment->content }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-600 dark:text-gray-300">No comments yet.</p>
                @endforelse

                {{-- Add Comment Form --}}
                <form method="POST" action="{{ route('blog.comment', $blog->id) }}" class="mt-4">
                    @csrf
                    <textarea name="content" class="w-full p-2 rounded border dark:bg-gray-900 dark:text-white" rows="3" placeholder="Leave a comment..."></textarea>
                    <x-primary-button class="mt-2">Post Comment</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

