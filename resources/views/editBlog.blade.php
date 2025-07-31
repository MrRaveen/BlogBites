<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Edit Blog Post</h2>

            <form action="{{ route('blog.update', $blog->blogID) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    {{-- Title --}}
    <div>
        <label class="block text-gray-700 dark:text-white font-semibold mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $blog->title) }}" class="w-full p-2 rounded dark:bg-gray-900 dark:text-white border border-gray-300 dark:border-gray-600">
        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    {{-- Image --}}
    <div>
        <label class="block text-gray-700 dark:text-white font-semibold mb-1">Image</label><br>
        @if($blog->imageURL)
            <img src="{{ asset('storage/' . $blog->imageURL) }}" alt="Current Image" class="h-40 w-auto rounded mb-2 shadow">
        @endif
        <input type="file" name="image" class="w-full text-sm text-gray-500 dark:text-gray-300">
        @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    {{-- Category --}}
    <div>
        <label class="block text-gray-700 dark:text-white font-semibold mb-1">Category</label>
        <select name="categoryID" class="w-full p-2 rounded dark:bg-gray-900 dark:text-white border border-gray-300 dark:border-gray-600">
            @foreach($allCategories as $category)
                <option value="{{ $category->categoryID }}" @if($category->categoryID == $blog->categoryID) selected @endif>
                    {{ $category->categoryName }}
                </option>
            @endforeach
        </select>
        @error('categoryID') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    {{-- Tags --}}
    <div>
        <label class="block text-gray-700 dark:text-white font-semibold mb-1">Tags</label>
        <select name="tags[]" multiple class="w-full p-2 rounded dark:bg-gray-900 dark:text-white border border-gray-300 dark:border-gray-600">
            @foreach($allTags as $tag)
                <option value="{{ $tag->tagID }}" @if($blog->tags->pluck('tagID')->contains($tag->tagID)) selected @endif>
                    {{ $tag->tagName }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Content with Trix --}}
    <div>
        <label class="block text-gray-700 dark:text-white font-semibold mb-1">Content</label>
        <input id="x-content" type="hidden" name="content" value="{{ old('content', $blog->content) }}">
        <trix-editor input="x-content" class="trix-content bg-white dark:bg-gray-900 dark:text-white rounded p-2 shadow-sm border border-gray-300 dark:border-gray-600"></trix-editor>
        @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    {{-- Submit --}}
    <div class="pt-4">
        <x-primary-button>Update Blog</x-primary-button>
    </div>
</form>

        </div>
    </div>
   @push('styles')
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
    @endpush

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
    @endpush

</x-app-layout>
