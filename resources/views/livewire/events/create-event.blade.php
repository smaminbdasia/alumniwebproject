<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
            <div class="flex items-center mx-auto md:w-auto px-4 md:px-8 xl:px-0">
                <div class="w-full">

                    <h1
                        class="mb-4 text-2xl font-black tracking-tight text-gray-900 sm:mb-6 leding-tight dark:text-white">
                        Events
                    </h1>


                    <!-- Events Table -->
                    <div>
                        <h2 class="text-lg font-bold mt-6">Saved Events</h2>
                        <table class="text-center text-gray-900 sm:text-sm w-full border mt-4">
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
                                            <button wire:click="edit({{ $event->id }})"
                                                class="bg-yellow-500 text-white px-4 py-2 rounded">
                                                Edit
                                            </button>
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{-- <x-button wire:click="deleteEvent({{ $event->id }})"
                                                class="bg-red-500 text-white px-2 py-1 rounded">Delete</x-button> --}}
                                            <button wire:click="confirmDelete({{ $event->id }})"
                                                class="bg-red-500 text-white px-4 py-2 rounded">
                                                Delete
                                            </button>

                                        </td>




                                    </tr>
                                @endforeach
                            </tbody>
                        </table>



                    </div>

                    <div class="justify-items-center">

                        <h2 class="my-24 text-center text-xl font-bold mb-4">
                            {{ $editing ? 'Edit Event' : 'Create New Event' }}</h2>

                        @if (session()->has('message'))
                            <div class="text-center p-3 mb-4 text-green-700 bg-green-200 rounded">
                                {{ session('message') }}
                            </div>
                        @endif

                        <!-- Show Temporary Preview -->
                        @if ($cover_photo)
                            <div class="mt-2">
                                <p class="text-sm text-gray-600">Preview:</p>
                                <img src="{{ $cover_photo->temporaryUrl() }}"
                                    class="mt-2 w-auto h-40 object-cover border rounded-lg">
                            </div>
                        @endif
                    </div>


                    <form class="justify-items-center" wire:submit.prevent="save">

                        <div class="grid gap-5 mx-10 my-10 sm:grid-cols-2">

                            <div class="mb-3">
                                <label class="block font-semibold">Event Status</label>
                                <select wire:model="event_status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    <option value="active">Active</option>
                                    <option value="completed">Completed</option>
                                    <option value="announced">Announced</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="block font-semibold">Cover Photo</label>

                                <!-- File Input -->
                                <input type="file" wire:model="cover_photo"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">



                                @error('cover_photo')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="block">Title</label>
                                <input type="text" wire:model.blur="title"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                @error('title')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label>Title in Bangla</label>
                                <input type="text" wire:model.blur="title_bangla"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                @error('title_bangla')
                                    <span class="error text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label>Slug</label>
                                <input type="text" wire:model.blur="slug"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                @error('slug')
                                    <span class="error text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label>Type</label>
                                <select wire:model="type"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    <option value="public">Public</option>
                                    <option value="private">Private</option>
                                </select>
                                @error('type')
                                    <span class="error text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label>Date</label>
                                <input type="date" min="2024-01-01" wire:model.blur="date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                @error('date')
                                    <span class="error text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label>Registration Fee</label>
                                <input type="number" step="0" wire:model="reg_fee"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                @error('reg_fee')
                                    <span class="error text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label>Adult Guest Fee</label>
                                <input type="number" step="0" wire:model="adult_guest_fee"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                @error('adult_guest_fee')
                                    <span class="error text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label>Child Guest Fee</label>
                                <input type="number" step="0" wire:model="child_guest_fee"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                @error('child_guest_fee')
                                    <span class="error text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 sm:col-span-2">
                                <label class="block font-semibold">Short Description</label>
                                <textarea wire:model="short_description"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"></textarea>
                            </div>


                        </div>

                        <x-button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            {{ $editing ? 'Update Event' : 'Create New Event' }}
                        </x-button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    Livewire.on('confirm-delete', eventId => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('deleteEvent', eventId);
            }
        });
    });
</script>

<!-- Include SweetAlert2 if not already included -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

