<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Writer Requests</h2>

        @foreach ($requests as $request)
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $request->user->userName }}</h3>
                <p class="text-gray-600 dark:text-gray-300">{{ $request->user->email }}</p>

                <div class="mt-4 flex gap-3">
                    <form method="POST" action="{{ route('admin.writer.approve', $request->writterRequestID) }}">
                        @csrf
                        <x-primary-button class="bg-green-600 text-white px-4 py-2 rounded">Approve</x-primary-button>
                    </form>

                    <form method="POST" action="{{ route('admin.writer.reject', $request->writterRequestID) }}">
                        @csrf
                        <x-primary-button class="bg-red-600 text-white px-4 py-2 rounded">Reject</x-primary-button>
                    </form>
                </div>
            </div>
        @endforeach

        @if ($requests->isEmpty())
            <p class="text-gray-500 dark:text-gray-400">No pending writer requests.</p>
        @endif
    </div>
</x-app-layout>
