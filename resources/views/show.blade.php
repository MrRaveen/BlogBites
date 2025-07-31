<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-3xl font-bold">{{ $blog->title }}</h1>
        <p class="text-gray-600">By {{ $blog->owner->userName ?? 'Unknown' }}</p>
        <div class="mt-6 prose">{!! $blog->content !!}</div>
    </div>
</x-app-layout>
