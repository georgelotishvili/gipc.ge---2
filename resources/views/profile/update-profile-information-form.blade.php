<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Information Display -->
        <div class="col-span-6 sm:col-span-4 mb-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Your Profile Information') }}</h3>
            <div class="mt-2 flex items-center">
                @if($this->user->image)
                    <img src="{{ Storage::url($this->user->image->path) }}" alt="{{ $this->user->name }}" class="rounded-md h-20 w-20 object-cover mr-4">
                @else
                    <div class="rounded-md h-20 w-20 bg-gray-200 flex items-center justify-center mr-4">
                        <span class="text-gray-500 text-lg">{{ substr($this->user->name, 0, 1) }}</span>
                    </div>
                @endif
                <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ __('Name') }}: <span class="font-normal">{{ $this->user->name }}</span></p>
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100 mt-1">{{ __('Email') }}: <span class="font-normal">{{ $this->user->email }}</span></p>
                </div>
            </div>
        </div>

        <!-- Profile Photo -->
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
            <!-- Profile Photo File Input -->
            <input type="file" class="hidden"
                        wire:model="photo"
                        x-ref="photo"
                        x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                        " />

            <x-label for="photo" value="{{ __('Photo') }}" />

            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="! photoPreview">
                @if($this->user->image)
                    <img src="{{ Storage::url($this->user->image->path) }}" alt="{{ $this->user->name }}" class="rounded-md h-20 w-20 object-cover">
                @else
                    <div class="rounded-md h-20 w-20 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500 text-lg">{{ substr($this->user->name, 0, 1) }}</span>
                    </div>
                @endif
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview" style="display: none;">
                <span class="block rounded-md w-20 h-20 bg-cover bg-no-repeat bg-center"
                      x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>

            <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('Select A New Photo') }}
            </x-secondary-button>

            @if ($this->user->image)
                <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                    {{ __('Remove Photo') }}
                </x-secondary-button>
            @endif

            <x-input-error for="photo" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" 
                    type="text" 
                    class="mt-1 block w-full" 
                    wire:model.defer="state.name" 
                    required
                    autocomplete="name" />
            <p class="mt-1 text-sm text-gray-500">Current name: <span class="font-medium">{{ $this->user->name }}</span></p>
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" 
                    type="email" 
                    class="mt-1 block w-full" 
                    wire:model.defer="state.email" 
                    required
                    autocomplete="username" />
            <p class="mt-1 text-sm text-gray-500">Current email: <span class="font-medium">{{ $this->user->email }}</span></p>
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>