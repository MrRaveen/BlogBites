<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Blog Posts') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($blogs as $blog)
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    @if($blog->imageURL)
                        <img src="{{ asset('storage/' . $blog->imageURL) }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 flex items-center justify-center bg-gray-100 text-gray-400">
                            No Image
                        </div>
                    @endif

                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $blog->title }}</h3>
                        <p class="text-sm text-gray-600 mb-2">
                            Category: {{ $blog->category->categoryName ?? 'N/A' }}<br>
                            Author: {{ $blog->owner->userName ?? 'N/A' }}<br>
                            Status: <span class="font-semibold text-{{ $blog->blogStatus === 'published' ? 'green' : 'red' }}-600">
                                {{ ucfirst($blog->blogStatus) }}
                            </span>
                        </p>

                        <div class="flex flex-wrap gap-2 mt-4">
                            <a href="{{ route('admin.manage.posts.edit', $blog->blogID) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-xs">
                                Edit
                            </a>

                            <form action="{{ route('admin.manage.posts.delete', $blog->blogID) }}" method="POST" onsubmit="return confirm('Delete this blog?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded text-xs">Delete</button>
                            </form>

                            {{-- <form action="{{ route('admin.manage.posts.toggleStatus', $blog->blogID) }}" method="POST">
                                @csrf
                                <button class="bg-yellow-500 text-white px-3 py-1 rounded text-xs">
                                    {{ $blog->blogStatus === 'published' ? 'Unpublish' : 'Publish' }}
                                </button>
                            </form> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
