<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold mb-4 text-gray-900 dark:text-gray-100">
            Pending Blog Post Requests
        </h2>

        @foreach ($pendingBlogs as $blog)
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-10">
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-3">
                    {{ $blog->title }}
                </h3>

                {{-- Blog meta --}}
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                    By: {{ $blog->owner->userName }} |
                    Category: {{ $blog->category->categoryName ?? 'N/A' }}
                </p>

                {{-- Blog image --}}
                @if($blog->imageURL)
                    <div class="w-full max-w-md mb-6">
                        <img src="{{ asset('storage/' . $blog->imageURL) }}"
                             alt="Blog Image"
                             class="w-full h-60 object-cover rounded-lg border border-gray-300 shadow-sm">
                    </div>
                @endif

                {{-- Render HTML content safely --}}
                <div class="prose dark:prose-invert max-w-none mb-6">
                    {!! Str::limit($blog->content, 300, '...') !!}
                </div>

                {{-- Approve / Reject buttons --}}
                <div class="mt-6 flex justify-end gap-3">
                    <form action="{{ route('admin.post.approve', $blog->blogID) }}" method="POST">
                        @csrf
                        <x-primary-button class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg">
                            Approve
                        </x-primary-button>
                    </form>
                    <form action="{{ route('admin.post.reject', $blog->blogID) }}" method="POST">
                        @csrf
                        <x-primary-button class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg">
                            Reject
                        </x-primary-button>
                    </form>
                </div>
            </div>
        @endforeach

        @if ($pendingBlogs->isEmpty())
            <p class="text-gray-600 dark:text-gray-400 text-lg mt-8">
                No pending blog posts at this time.
            </p>
        @endif
    </div>
</x-app-layout>
