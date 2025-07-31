<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Manage User Roles</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white dark:bg-gray-800 rounded shadow">
            <thead>
                <tr class="text-left border-b">
                    <th class="py-2 px-4">User</th>
                    <th class="py-2 px-4">Email</th>
                    <th class="py-2 px-4">Current Role</th>
                    <th class="py-2 px-4">Change Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-b dark:border-gray-700">
                        <td class="py-2 px-4">{{ $user->userName }}</td>
                        <td class="py-2 px-4">{{ $user->email }}</td>
                        <td class="py-2 px-4">{{ $user->roles->pluck('name')->first() ?? 'None' }}</td>
                        <td class="py-2 px-4">
                            <form action="{{ route('admin.user.updateRole', $user->userID) }}" method="POST" class="flex gap-2">
                                @csrf
                                @method('PUT')
                                <select name="role" class="rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                                    @foreach($roles as $role)
                                        <option value="{{ $role }}" {{ $user->roles->pluck('name')->first() == $role ? 'selected' : '' }}>
                                            {{ ucfirst($role) }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                                    Update
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
