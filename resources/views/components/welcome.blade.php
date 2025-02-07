<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    {{-- <x-application-logo class="block h-12 w-auto" /> --}}

    <div class="justify-items-center">

        {{-- <form action="{{ route('profile.show') }}" method="GET">
            <x-button>
                Upload Profile Photo
            </x-button>
        </form> --}}

        @if (auth()->user()->profile_photo_path)
            <div class="">
                <img class="my-4 w-36 h-36 rounded-lg" src="{{ Auth::user()->profile_photo_url }}"
                    alt="{{ Auth::user()->name }}" />
            </div>

            {{-- <p class="text-sm text-gray-600 my-2">Profile photo uploaded.</p> --}}


            <h1 class="my-3 text-2xl bangla-noto-500 font-medium text-gray-900 dark:text-white">
                অভিনন্দন, {{ Auth::user()->nameBangla }}!
            </h1>
            <p class="mt-3 text-green-500 bangla-noto-500 dark:text-gray-400 leading-relaxed">
                আপনার নিবন্ধনের আবেদনটি গৃহীত হয়েছে।
            </p>
            <div class="mt-3 border border1 rounded-lg">
                <div class="px-5 py-2 text-center">

                    <div class="text-sm bangla-noto-400 text-gray-500">
                        রেজিস্ট্রেশন আইডি
                    </div>
                    <div class="text-lg font-bold text-indigo-700">
                        {{ Auth::user()->reg_id }}
                    </div>
                </div>
            </div>

            <h1 class="mt-3 text-xs font-medium text-gray-400 dark:text-white">
                Dakhil Batch: <span class="font-black text-gray-900"> {{ Auth::user()->dakhilBatch }}</span>
            </h1>
            {{-- <h1 class="mt-3 text-xs font-medium text-gray-400 dark:text-white">
                Formal Name: <span class="font-black uppercase text-gray-900"> {{ Auth::user()->name }}</span>
            </h1>
            <h1 class="mt-1 text-xs font-medium text-gray-400 dark:text-white">
                Father's Name: <span class="font-black uppercase text-gray-900"> {{ Auth::user()->father }}</span>
            </h1> --}}


            <br>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <x-button>
                    Logout
                </x-button>
            </form>
            <h1 class="my-3 bangla-noto-600 text-sm text-gray-600 mt-2">
                অ্যাকাউন্টের নিরাপত্তার স্বার্থে লগআউট করতে ভুলবেন না।
            </h1>
        @else
            <div class="justify-items-center">
                {{-- Steps --}}
                <ol
                    class="flex items-center mb-6 text-sm font-medium text-center text-green-600 dark:text-gray-400 lg:mb-12 sm:text-base">
                    <li
                        class="flex items-center text-primary-600 dark:text-primary-500 sm:after:content-[''] after:w-12 after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                        <div
                            class="flex items-center sm:block after:content-['/'] sm:after:hidden after:mx-2 after:font-light after:text-gray-200 dark:after:text-gray-500">
                            <svg class="w-4 h-4 mr-2 sm:mb-2 sm:w-6 sm:h-6 sm:mx-auto" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Profile <span class="hidden sm:inline-flex">Details</span>
                        </div>
                    </li>
                    <li
                        class="flex items-center after:content-[''] after:w-12 after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                        <div
                            class="flex items-center sm:block after:content-['/'] sm:after:hidden after:mx-2 after:font-light after:text-gray-200 dark:after:text-gray-500">
                            <svg class="w-4 h-4 mr-2 sm:mb-2 sm:w-6 sm:h-6 sm:mx-auto" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Payment <span class="hidden sm:inline-flex">Info</span>
                        </div>
                    </li>
                    <li class="flex items-center sm:block text-indigo-500">
                        <div class="mr-2 sm:mb-2 sm:mx-auto">3</div>
                        Photo <span class="hidden sm:inline-flex">Upload</span>
                    </li>
                </ol>

                {{-- <div class="">
                    <img class="mt-4 mb-4 w-36 h-36 rounded-lg" src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}" />
                </div>

                <h1 class="bangla-noto-600 text-sm text-gray-600 mt-2">
                    নিবন্ধন সম্পন্ন করতে আপনার ছবি আপলোড করুন
                </h1> --}}

                <div>
                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                        @livewire('profile.update-profile-information-form')

                        @endif
                    </div>
                    <x-section-border />

                {{-- <form action="{{ route('profile.show') }}" method="GET">
                    <div class="mt-3">
                        <x-button>
                            Upload Your Photo
                        </x-button>
                    </div>
                </form> --}}
            </div>
        @endif



    </div>



</div>

<div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
</div>
