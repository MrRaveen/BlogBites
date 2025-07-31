<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Search Results for "{{ $query }}"</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($blogs->isEmpty())
            <p class="text-gray-500">No blogs found matching your search.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($blogs as $blog)
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        @if($blog->imageURL)
                            <img src="{{ asset('storage/' . $blog->imageURL) }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 flex items-center justify-center bg-gray-100 text-gray-400">No Image</div>
                        @endif

                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $blog->title }}</h3>
                            <p class="text-sm text-gray-600">
                                Category: {{ $blog->category->categoryName ?? 'N/A' }}<br>
                                Author: {{ $blog->owner->userName ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
