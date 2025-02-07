    <!-- Events Table -->
    <h2 class="text-lg font-bold mt-6">Saved Events</h2>

    <table class="w-full border mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Cover</th>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">Type</th>
                <th class="border px-4 py-2">Date</th>
                <th class="border px-4 py-2">Reg Fee</th>
                <th class="border px-4 py-2">Adult Guest Fee</th>
                <th class="border px-4 py-2">Child Guest Fee</th>
                <th class="border px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td class="border px-4 py-2 h-4 w-auto">
                        @if ($event->cover_photo)
                            <img src="{{ asset('storage/' . $event->cover_photo) }}"
                                class="w-20 h-20 object-cover">
                        @else
                            None
                        @endif
                    </td>
                    <td class="border px-4 py-2">{{ $event->id }}</td>
                    <td class="border px-4 py-2">{{ $event->title }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($event->type) }}</td>
                    <td class="border px-4 py-2">{{ $event->date }}</td>
                    <td class="border px-4 py-2">{{ $event->reg_fee }}</td>
                    <td class="border px-4 py-2">{{ $event->adult_guest_fee }}</td>
                    <td class="border px-4 py-2">{{ $event->child_guest_fee }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($event->event_status) }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $event->id }})" class="bg-yellow-500 text-white px-4 py-2 rounded">
                            Edit
                        </button>
                    </td>

                    <td class="border px-4 py-2">
                        <x-button wire:click="deleteEvent({{ $event->id }})"
                            class="bg-red-500 text-white px-2 py-1 rounded">Delete</x-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
