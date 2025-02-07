<!-- Block start -->
<section class="bg-white dark:bg-gray-900">
    <div class="px-4 pt-8 mx-auto max-w-screen-xl text-center justify-items-center lg:pt-16 lg:pb-8 lg:px-12">
        <h1
            class="mb-4 text-2xl bangla-noto-500 font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
            ফটোফ্রেম
        </h1>
        <p
            class="mb-4 text-base bangla-noto-500 font-bold tracking-tight leading-none text-gray-900 md:text-xl lg:text-xl dark:text-white">
            এখানে আপনার স্কয়ার সাইজের বা বর্গাকৃতির ছবি আপলোড করুন
        </p>

        <div class="text-center justify-items-center">
            <!-- Upload Photo -->
            <input type="file" wire:model="photo">

            @if ($photo)
                <p class="my-4">Preview:</p>
                <img src="{{ $framedPhotoUrl }}" class="w-64 h-64 mt-4 rounded-lg">

                <x-button wire:click="downloadFramedPhoto" class="bg-indigo-800 text-white p-2 mt-4 bangla-noto-500">
                    ডাউনলোড
                </x-button>
            @endif
        </div>

    </div>
</section>
