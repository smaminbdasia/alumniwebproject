<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @php
                $event = \App\Models\Event::where('slug', 'reunion')->first();
                $hasSignedUp = $event
                    ? \App\Models\EventReg::where('user_id', auth()->id())
                        ->where('event_id', $event->id)
                        ->exists()
                    : false;
            @endphp

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @if ($event && !$hasSignedUp)
                    @livewire('event.event-signup', ['event' => $event])
                @endif
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @if ($hasSignedUp)
                    <x-welcome />
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
