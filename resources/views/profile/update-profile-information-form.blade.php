<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        <span class="bangla-noto-500">
            {{ __('আপনার প্রোফাইলের ছবি আপলোডের ক্ষেত্রে ১ মেগাবাইট সাইজের থেকে ছোট এবং বর্গাকৃতির ছবি আপলোড দিন।') }}
            {{-- {{ __('Update your account\'s profile information and email address.') }} --}}
        </span>
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
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
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="rounded-3xl size-28 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-3xl size-28 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>
                <div class="mt-3 flex items-center">

                    <x-secondary-button class=" me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Upload') }}
                    </x-secondary-button>

                    @if ($this->user->profile_photo_path)
                        <x-secondary-button type="button" class="" wire:click="deleteProfilePhoto">
                            {{ __('Remove') }}
                        </x-secondary-button>
                        <button type="button"
                            class="text-sm px-5 py-2 text-center inline-flex items-center me-2 ms-2 font-medium rounded-lg text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            onclick="window.location.href='{{ route('dashboard') }}'">
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 me-2 text-gray-100 dark:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                            </svg>
                            {{ __('Dashboard') }}
                        </button>
                </div>
                <h1 class="bangla-noto-600 text-base text-indigo-600 mt-2">
                    রেজিস্ট্রেশন আইডি পেতে ড্যাশবোর্ডে ফিরে যান
                </h1>
            @else
                <h1 class="bangla-noto-600 text-base text-red-600 mt-2">
                    ছবি আপলোড করে সেভ বাটন চাপুন
                </h1>
        @endif

        <x-input-error for="photo" class="mt-2" />
        </div>
        @endif

        <!-- Name -->
        <div class="mt-8 col-span-6 sm:col-span-4">
            {{-- <x-label for="name" value="{{ __('Name') }}" /> --}}
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required
                autocomplete="name" disabled />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-3 col-span-6 sm:col-span-4">
            {{-- <x-label for="phone" value="{{ __('Phone') }}" /> --}}
            <x-input id="phone" type="text" class="mt-1 block w-full" wire:model="state.phone" required
                autocomplete="phone" disabled/>
            <x-input-error for="phone" class="mt-2" />
        </div>


        <!-- Email -->
        <div class="mt-3 mb-6 col-span-6 sm:col-span-4">
            {{-- <x-label for="email" value="{{ __('Email') }}" /> --}}
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required
                autocomplete="username" disabled/>
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                    !$this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 dark:text-white">
                    {{ __('Your email address is unverified.') }}

                    <button type="button"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
