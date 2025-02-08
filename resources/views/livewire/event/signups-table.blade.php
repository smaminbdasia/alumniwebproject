<div class="p-6 bg-white rounded-lg shadow">

    <div class="flex items-center space-x-2 mb-4">
        <input type="text" wire:model="search" wire:change="applyFilters" placeholder="Search..."
            class="rounded-lg input input-bordered w-full max-w-xs" />

        <select wire:model.lazy="batchFilter" class="rounded-lg select select-bordered">
            <option value="">Batches</option>
            @foreach ($batches as $batch)
                <option value="{{ $batch }}">{{ $batch }}</option>
            @endforeach
        </select>

        <select wire:model.lazy="paymentStatusFilter" class="rounded-lg select select-bordered">
            <option value="">Payment</option>
            <option value="paymentverified">Verified</option>
            <option value="notyet">Not Verified yet</option>
            <option value="invalid">Invalid</option>
        </select>

        <button wire:click="applyFilters"
            class="p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </button>

    </div>

    <div class="mt-4">{{ $signups->links() }}</div>

    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
        <thead class="bg-gray-100 dark:bg-gray-700">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all" aria-describedby="checkbox-1" type="checkbox"
                            class="w-4 h-4 bg-gray-50 rounded border-gray-300 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-all" class="sr-only">checkbox</label>
                    </div>
                </th>
                <th scope="col" wire:click="sortBy('reg_id')"
                    class="cursor-pointer p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Alumni ID
                    @if ($sortField === 'reg_id')
                        <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                    @endif
                </th>
                <th scope="col" wire:click="sortBy('name')"
                    class="cursor-pointer p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Name
                    @if ($sortField === 'name')
                        <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                    @endif
                </th>
                <th scope="col"
                    class="cursor-pointer p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Father
                </th>
                <th scope="col" wire:click="sortBy('district')"
                    class="cursor-pointer p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    District
                    @if ($sortField === 'district')
                        <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                    @endif
                </th>
                <th scope="col" wire:click="sortBy('verified')"
                    class="cursor-pointer p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Payment Verification
                    @if ($sortField === 'verified')
                        <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                    @endif
                </th>

            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
            @foreach ($signups as $signup)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="p-4 w-4">
                        <div class="flex items-center">
                            <input id="checkbox-1" aria-describedby="checkbox-1" type="checkbox"
                                class="w-4 h-4 bg-gray-50 rounded border-gray-300 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <td class="p-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $signup->user->reg_id }}
                        <div class="text-xs font-normal text-gray-500 dark:text-gray-400">
                            {{ $signup->user->dakhilBatch }}
                        </div>
                    </td>
                    <td class="flex items-center p-4 mr-12 space-x-6 whitespace-nowrap lg:mr-0">
                        <img class="w-10 h-10 rounded-full" src={{ $signup->user->profile_photo_url }}
                            alt="Profile Photo">
                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                            <div class="text-base font-semibold text-gray-900 dark:text-white">
                                {{ $signup->user->name }}
                            </div>
                            <div class="text-xs font-normal bangla-noto-500 text-gray-500 dark:text-gray-400">
                                {{ $signup->user->nameBangla }}
                            </div>
                        </div>
                    </td>
                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $signup->user->father }}</td>
                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $signup->user->district }}</td>
                    <td class="p-4 text-base font-normal text-gray-900 whitespace-nowrap dark:text-white">
                        @if ($signup->verified === 'paymentverified')
                            <div class="flex items-center ">
                                <div class="h-2 w-2 rounded-full bg-green-400 mr-2"></div>
                                <span class="text-sm ">Verified</span>
                            </div>
                        @else
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-yellow-400 mr-2"></div>
                                <span class="text-sm">Not Verified Yet</span>
                            </div>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>
