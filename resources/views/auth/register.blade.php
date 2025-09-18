
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-purple-700" />
            <x-text-input id="name" class="block mt-1 w-full border-pink-300 focus:border-purple-400 focus:ring focus:ring-purple-200 rounded-xl" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-pink-600" />
        </div>

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('UserName')" class="text-purple-700" />
            <x-text-input id="username" class="block mt-1 w-full border-pink-300 focus:border-purple-400 focus:ring focus:ring-purple-200 rounded-xl" type="text" name="username" :value="old('username')" required />
            <x-input-error :messages="$errors->get('username')" class="mt-2 text-pink-600" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-purple-700" />
            <x-text-input id="email" class="block mt-1 w-full border-pink-300 focus:border-purple-400 focus:ring focus:ring-purple-200 rounded-xl" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-600" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-purple-700" />
            <x-text-input id="password" class="block mt-1 w-full border-pink-300 focus:border-purple-400 focus:ring focus:ring-purple-200 rounded-xl" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-600" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-purple-700" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border-pink-300 focus:border-purple-400 focus:ring focus:ring-purple-200 rounded-xl" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-pink-600" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-purple-600 hover:text-pink-600 transition" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4 bg-gradient-to-r from-pink-400 via-purple-400 to-sky-400 hover:from-sky-400 hover:to-pink-400 text-white font-semibold rounded-xl shadow-md">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
