<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-xl shadow">
        <h2 class="text-2xl font-bold mb-6">Create New Blog</h2>

        @if (session('success'))
            <div class="text-green-500 mb-4">{{ session('success') }}</div>
        @endif

        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block">Title</label>
                <input name="title" type="text" class="w-full border rounded p-2" value="{{ old('title') }}">
                @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-2">Content</label>
                <input id="x" type="hidden" name="content" value="{{ old('content') }}">
                <trix-editor input="x"></trix-editor>
                @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block">Image</label>
                <input name="image" type="file" class="w-full">
                @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block">Category</label>
                <select name="categoryID" class="w-full border rounded p-2">
                    <option value="">-- Select --</option>
                    @foreach($allCategories as $cat)
                        <option value="{{ $cat->categoryID }}" {{ old('categoryID') == $cat->categoryID ? 'selected' : '' }}>
                            {{ $cat->categoryName }}
                        </option>
                    @endforeach
                </select>
                @error('categoryID') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block">Tags</label>
                <div class="flex flex-wrap gap-2">
                    @foreach($allTags as $tag)
                        <label class="flex items-center">
                            <input type="checkbox" name="tags[]" value="{{ $tag->tagID }}"
                                {{ is_array(old('tags')) && in_array($tag->tagID, old('tags')) ? 'checked' : '' }}>
                            {{ $tag->tagName }}
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Blog</button>
        </form>
    </div>

    @push('styles')
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
    @endpush

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
    @endpush
</x-app-layout>
