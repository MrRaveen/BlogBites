<x-app-layout>
     @if(isset($profile))
        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                 {{-- <livewire:profile.profileInformationPart /> --}}
                 <section>
    <div class="flex gap-4">
        <div>
            <img src="{{ $profile->profileImage }}" class="w-50 h-50 object-cover rounded-full border-4 border-indigo-500 shadow-inner bg-gray-200 dark:bg-gray-900" alt="User Profile Image" />
        </div>
        <div class="flex flex-col justify-center items-start">
            <div class="text-3xl font-normal text-gray-900 dark:text-gray-100 mb-2">{{ $profile->userName }}</div>
            <div class="text-2xl font-normal text-gray-900 dark:text-gray-100 mb-2">{{ $profile->email }}</div>
            <div class="text-2xl font-normal text-gray-900 dark:text-gray-100 mb-4">
                Blog post: <span class="font-bold">{{ $profile->blogs_count }}</span>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('blog.create') }}">
                    <x-primary-button>Create post</x-primary-button>
                </a>
                <a href="{{ route('saved.posts') }}">
                    <x-secondary-button>View Saved Posts</x-secondary-button>
                </a>
            </div>
        </div>
    </div>
</section>
            </div>

    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Your Blog Posts</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($profile->blogs as $blog)
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('storage/' . $blog->imageURL) }}" class="w-full h-40 object-cover" alt="Blog Image">

                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">{{ $blog->title }}</h3>

                    <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-3">{{ Str::limit(strip_tags($blog->content), 100) }}</p>

                    <div class="mt-3 text-sm">
                        <span class="inline-block px-2 py-1 rounded
                            {{ $blog->blogStatus === 'APPROVED' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                            {{ ucfirst($blog->blogStatus) }}
                        </span>
                    </div>

                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('showSingleBlogsEndpoint', $blog->slug) }}" class="text-blue-600 hover:underline">View</a>

                        <div class="flex items-center gap-3">
                            {{-- TODO: LATER
                            action="{{ route('blog.like', $blog->id) }}" --}}
                            @php
                            $isLiked = in_array($blog->blogID, $likedBlogIDs ?? []);
                            @endphp
                            <form method="POST" action="{{ route('blog.like', $blog->blogID) }}">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                   {{ $isLiked ? '💖' : '🤍' }} {{ $blog->likes_count ?? 0 }}
                                </button>
                            </form>
                            <div class="flex items-center gap-2 mt-2">
    <a href="{{ route('blog.edit', $blog->blogID) }}" class="text-yellow-500 hover:underline">✏️ Edit</a>
    <form action="{{ route('blog.delete', $blog->blogID) }}" method="POST" onsubmit="return confirm('Are you sure?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-500 hover:text-red-700">🗑️ Delete</button>
    </form>
</div>

                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-600 dark:text-gray-300">You haven’t posted any blogs yet.</p>
        @endforelse
    </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Profile not found</h2>
                    <p class="mt-4 text-gray-600 dark:text-gray-300">The profile you are looking for does not exist.</p>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
