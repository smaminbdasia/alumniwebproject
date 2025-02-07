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
            class="rounded-full size-20 object-cover">
    </div>

    <!-- New Profile Photo Preview -->
    <div class="mt-2" x-show="photoPreview" style="display: none;">
        <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center"
            x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
        </span>
    </div>

    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
        {{ __('Select A New Photo') }}
    </x-secondary-button>

    @if ($this->user->profile_photo_path)
        <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
            {{ __('Remove Photo') }}
        </x-secondary-button>
        <h1 class="bangla-noto-600 text-base text-red-600 mt-2">
        ছবি আপলোড সম্পন্ন হয়েছে। আপনার রেজিস্ট্রেশন আইডি পেতে ড্যাশবোর্ডে ফিরে যান।
        </h1>
        <x-secondary-button type="button" class="mt-2" onclick="window.location.href='{{ route('dashboard') }}'">
            {{ __('Back to Dashboard') }}
        </x-secondary-button>
    @else
        <h1 class="bangla-noto-600 text-base text-red-600 mt-2">
            নিবন্ধন সম্পন্ন করতে আপনার ছবি আপলোড করুন
        </h1>
    @endif

    <x-input-error for="photo" class="mt-2" />
</div>
@endif
