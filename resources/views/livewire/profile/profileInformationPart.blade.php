<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\BlogUser;

$userId = Auth::id();

$profile = Cache::remember('bloguser_profile_' . $userId, 60 * 60, function() use ($userId) {
    return BlogUser::withCount('blogs')->findOrFail($userId);
});
?>
 <section>
    <div class="flex gap-4">
        <div>
            <img src="{{ $profile->profileImage }}" class="w-72 h-72 object-cover rounded-full border-4 border-indigo-500 shadow-inner bg-gray-200 dark:bg-gray-900" alt="User Profile Image" />
        </div>
        <div class="flex flex-col justify-center items-start">
            <div class="text-3xl font-normal text-gray-900 dark:text-gray-100 mb-2">{{ $profile->userName }}</div>
            <div class="text-2xl font-normal text-gray-900 dark:text-gray-100 mb-2">{{ $profile->email }}</div>
            <div class="text-2xl font-normal text-gray-900 dark:text-gray-100 mb-4">
                Blog post: <span class="font-bold">{{ $profile->blogs_count }}</span>
            </div>
            <div class="flex gap-4">
                <x-primary-button>View saved posts</x-primary-button>
                <x-primary-button>Create post</x-primary-button>
            </div>
        </div>
    </div>
</section>



