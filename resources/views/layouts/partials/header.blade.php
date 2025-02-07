<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- @livewire('navigation-menu') --}}

        {{-- <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif --}}

        {{-- Page Heading --}}
        <header class="flex items-center justify-between py-3 px-6 border-b border-gray-100">
            <div id="header-left" class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>
                <div class="top-menu ml-10">
                    <ul class="flex space-x-4">
                        <li>
                            <a class="flex space-x-2 items-center hover:text-yellow-500 text-sm text-gray-500 focus:text-yellow-500"
                                href="{{ route('home') }}">
                                Home
                            </a>
                        </li>

                        {{-- <li>
                            <a class="flex space-x-2 items-center hover:text-yellow-500 text-sm text-gray-500 focus:text-yellow-500"
                                href="{{ route('about') }}">
                                About
                            </a>
                        </li> --}}

                        {{-- <li>
                            <a class="flex space-x-2 items-center hover:text-yellow-500 text-sm text-gray-500 focus:text-yellow-500"
                                href="{{ route('dashboard') }}">
                                Dashboard
                            </a>
                        </li> --}}

                        {{-- <li>
                            <a class="flex space-x-2 items-center hover:text-yellow-500 text-sm text-gray-500 focus:text-yellow-500"
                                href="{{ route('contact-us') }}">
                                Contact Us
                            </a>
                        </li> --}}


                    </ul>
                </div>
            </div>
            <div id="header-right" class="flex items-center md:space-x-6">

                @guest
                    @include('layouts.partials.header-right-guest')
                @endguest

                @auth
                    @include('layouts.partials.header-right-auth')
                @endauth
            </div>
        </header>
    </div>
</nav>
