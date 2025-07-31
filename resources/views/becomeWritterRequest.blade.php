<x-app-layout>
    <div class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <h2 class="text-xl font-semibold mb-6 text-gray-800 dark:text-white">Request to Become a Writer</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if ($existing)
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
                You've already requested to become a writer. Status: <strong>{{ ucfirst($existing->requestSatus) }}</strong>
            </div>
        @else
            <form method="POST" action="{{ route('writer.request.submit') }}">
                @csrf
                <p class="mb-4 text-gray-600 dark:text-gray-300">
                    Submit a request to become a writer. An admin will review and approve your access.
                </p>
                <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                    Send Request
                </button>
            </form>
        @endif
    </div>
</x-app-layout>
