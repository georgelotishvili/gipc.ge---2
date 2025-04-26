<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-application-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('სახელი') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('ელ-ფოსტა') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('პაროლი') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('გაიმეორეთ პაროლი') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-5">
                <div class="flex items-start">
                    <x-checkbox name="terms" id="terms" required class="h-5 w-5 mt-1 border-gray-300" />
                    <label for="terms" class="ml-3 text-sm text-gray-600">
                        ვეთანხმები
                        <a href="{{ route('terms-and-conditions') }}" class="font-medium text-blue-600 border-b-2 border-blue-600 hover:text-blue-800 hover:border-blue-800 transition duration-150">
                            წესებს და პირობებს
                        </a>
                        და
                        <a href="{{ route('privacy-policy') }}" class="font-medium text-indigo-600 border-b-2 border-indigo-600 hover:text-indigo-800 hover:border-indigo-800 transition duration-150">
                            კონფიდენციალურობის პოლიტიკას
                        </a>
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('უკვე დარეგისტრირებული ხართ?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('რეგისტრაცია') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
