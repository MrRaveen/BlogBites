<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Blog Post') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-xl shadow">
        @if (session('success'))
            <div class="text-green-500 mb-4">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.manage.posts.update', $blog->blogID) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Title</label>
                <input name="title" type="text" class="w-full border rounded p-2" value="{{ old('title', $blog->title) }}" required>
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700 mb-2">Content</label>
                <input id="content" type="hidden" name="content" value="{{ old('content', $blog->content) }}" required>
                <trix-editor input="content"></trix-editor>
                @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Category</label>
                <select name="categoryID" class="w-full border rounded p-2" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->categoryID }}" {{ $category->categoryID == $blog->categoryID ? 'selected' : '' }}>
                            {{ $category->categoryName }}
                        </option>
                    @endforeach
                </select>
                @error('categoryID') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700 mb-1">Current Image</label>
                @if($blog->imageURL)
                    <img src="{{ asset('storage/' . $blog->imageURL) }}" class="w-full h-48 object-cover rounded mb-2" />
                @else
                    <p class="text-gray-500 italic">No image uploaded.</p>
                @endif
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Change Image</label>
                <input name="image" type="file" class="w-full border rounded p-2">
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <x-primary-button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Update Blog
            </x-primary-button>
        </form>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
    @endpush

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
    @endpush
</x-app-layout>
