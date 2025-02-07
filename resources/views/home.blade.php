<x-guest-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <img src="{{ 'image/BKM-Reunion-Cover-(1).jpg' }}" alt="Reunion Cover">
            </div>
        </div>
    </div>
    <div class="px-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @include('homepage.herosection')
    </div>
    <div class="px-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @include('homepage.section2')
    </div>

    <div>
        @include('homepage.banner1')
    </div>

    <div class="px-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @include('homepage.section3')
    </div>

    <div>
        @include('homepage.banner2')
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center justify-items-center bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
                @livewire('events.photo-frame')
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center justify-items-center bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">

            </div>
        </div>
    </div>



</x-app-layout>
