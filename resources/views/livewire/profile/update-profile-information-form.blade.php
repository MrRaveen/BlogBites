<?php

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

use function Livewire\Volt\state;
?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>
    </header>

    <!-- User Profile Info Card -->
    <div class="flex flex-col sm:flex-row items-center sm:items-start bg-white dark:bg-gray-800 rounded-lg shadow p-8 mb-6 min-h-[320px]">
        <div class="flex justify-center items-center w-64 h-64 rounded-full bg-black text-white border-2 border-gray-400 mb-6 sm:mb-0 sm:mr-10">
                    <img src="https://i.pravatar.cc/100?img=3" alt="User Profile Image" class="w-24 h-24 rounded-full border-2 border-indigo-500 mb-4 sm:mb-0 sm:mr-6">
        </div>
        <div class="flex-1 flex flex-col justify-center items-start">
            <div class="text-3xl font-normal text-gray-900 dark:text-gray-100 mb-2">User name</div>
            <div class="text-2xl font-normal text-gray-900 dark:text-gray-100 mb-2">Email</div>
            <div class="text-2xl font-normal text-gray-900 dark:text-gray-100 mb-6">Blog post: <span class="font-bold">12</span></div>
            <div class="flex gap-4">
                <button class="px-4 py-2 border border-gray-300 dark:border-gray-500 bg-transparent text-white dark:text-white rounded hover:bg-gray-700 hover:text-white transition">
                    View saved posts
                </button>
                <button class="px-4 py-2 border border-gray-300 dark:border-gray-500 bg-transparent text-white dark:text-white rounded hover:bg-gray-700 hover:text-white transition">
                    Create post
                </button>
            </div>
        </div>
    </div>
</section>

{{-- <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section> --}}
