<div class="container mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">Upcoming Events</h1>

    <!-- Event List -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($events as $event)
            <div class="border rounded-lg shadow p-4 cursor-pointer" wire:click="showEvent({{ $event->id }})">
                @if ($event->cover_photo)
                    <img src="{{ asset('storage/' . $event->cover_photo) }}" class="w-full h-40 object-cover rounded">
                @endif
                <h2 class="text-lg font-semibold mt-2">{{ $event->title }}</h2>
                <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($event->date)->format('F d, Y') }}</p>
                <p class="mt-2 text-gray-700">{{ Str::limit($event->short_description, 100) }}</p>
            </div>
        @endforeach
    </div>

    <!-- Event Details (Show only when an event is clicked) -->
    @if ($selectedEvent)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-2/3">
                <button class="absolute top-2 right-2 text-gray-500" wire:click="$set('selectedEvent', null)">✖</button>

                @if ($selectedEvent->cover_photo)
                    <img src="{{ asset('storage/' . $selectedEvent->cover_photo) }}" class="w-full h-64 object-cover rounded">
                @endif

                <h1 class="text-2xl font-bold mt-4">{{ $selectedEvent->title }}</h1>
                <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($selectedEvent->date)->format('F d, Y') }}</p>

                <div class="mt-4 text-gray-700">
                    <p>{{ $selectedEvent->short_description }}</p>
                </div>

                <div class="mt-6">
                    <p><strong>Registration Fee:</strong> ৳{{ number_format($selectedEvent->reg_fee, 0) }}</p>
                    <p><strong>Adult Guest Fee:</strong> ৳{{ number_format($selectedEvent->adult_guest_fee, 0) }}</p>
                    <p><strong>Child Guest Fee:</strong> ৳{{ number_format($selectedEvent->child_guest_fee, 0) }}</p>
                </div>
            </div>
        </div>
    @endif
</div>
