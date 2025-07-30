<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                 {{-- <livewire:profile.profileInformationPart /> --}}
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
                <a href="{{ route('create.blog') }}">
                    <x-primary-button>Create post</x-primary-button>
                </a>
                <x-primary-button>View Posts</x-primary-button>
            </div>
        </div>
    </div>
</section>
                 {{-- <livewire:profile.profileInformationPart :profile="$profile" /> --}}
            </div>

            {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div> --}}

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
