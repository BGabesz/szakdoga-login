<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
            <img src="kepek/logo.jpg" style="width: 100px; height: auto">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Név')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email cím')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Jelszó')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Jelszó újra')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <!-- Neme -->
            <div class="mt-4">
                <x-label for="neme" :value="__('Neme')" />

                <x-input id="neme" class="block mt-1 w-full" type="text" name="neme" :value="old('neme')" required autofocus />
            </div>

            <!-- Születési Dátum -->
            <div class="mt-4">
                <x-label for="szul_datum" :value="__('Születési dátum')" />

                <x-input id="szul_datum" class="block mt-1 w-full" type="date" name="szul_datum" :value="old('szul_datum')" required autofocus />
            </div>

            <!-- Telefonszám -->
            <div class="mt-4">
                <x-label for="tel_szam" :value="__('Telefonszám')" />

                <x-input id="tel_szam" class="block mt-1 w-full" type="number" name="tel_szam" :value="old('tel_szam')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
