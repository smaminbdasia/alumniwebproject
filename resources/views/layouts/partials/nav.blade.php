<div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
        <div class="flex items-center justify-start rtl:justify-end">
            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                type="button"
                class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                    </path>
                </svg>
            </button>
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex ms-2 md:me-24">
                {{-- <div class="shrink-0 flex items-center"> --}}
                <div class="flex items-center">
                    <x-application-mark class="block w-auto" />
                    <div class="">
                        <p class="text-sm bangla-noto-400 text-gray-600 ms-3">বোয়াইলমারী কামিল মাদরাসা<br>অ্যালামনাই
                            অ্যাসোসিয়েশন</p>
                    </div>
                </div>


                {{-- </div> --}}
            </a>
        </div>
        <div class="flex items-center">

            @guest
                @include('layouts.partials.header-right-guest')
            @endguest

            @auth
                @include('layouts.partials.header-right-auth')
            @endauth


        </div>
    </div>
</div>
</div>
