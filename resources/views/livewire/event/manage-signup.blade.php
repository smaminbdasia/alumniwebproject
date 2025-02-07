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
                    Contact
                </th>
                <th scope="col"
                    class="cursor-pointer p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Guest Fee
                </th>
                <th scope="col"
                    class="cursor-pointer p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Reg Fee
                </th>
                <th scope="col"
                    class="cursor-pointer p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Method
                </th>
                <th scope="col"
                    class="cursor-pointer p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    TRX (Bank)
                </th>
                <th scope="col"
                    class="cursor-pointer p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    TRX (bKash)
                </th>
                <th scope="col" wire:click="sortBy('verified')"
                    class="cursor-pointer p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Payment Verification
                    @if ($sortField === 'verified')
                        <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                    @endif
                </th>
                <th scope="col"
                    class="cursor-pointer p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                    Actions
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
                            alt="Neil Sims avatar">
                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                            <div class="text-base font-semibold text-gray-900 dark:text-white">
                                {{ $signup->user->name }}
                            </div>
                            <div class="text-xs font-normal bangla-noto-500 text-gray-500 dark:text-gray-400">
                                {{ $signup->user->nameBangla }}
                            </div>
                        </div>
                    </td>
                    <td class="p-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $signup->user->phone }}
                        <div class="text-xs font-normal text-gray-500 dark:text-gray-400">
                            {{ $signup->user->email }}
                        </div>
                    </td>
                    <td class="p-4 text-base font-medium text-gray-500 whitespace-nowrap dark:text-white">
                        {{ $signup->guest_fee }}</td>

                    <td class="p-4 text-base font-medium text-gray-500 whitespace-nowrap dark:text-white">
                        {{ $signup->reg_fee }}</td>

                        <td class="p-4 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">
                        {{ $signup->payment_method }}</td>

                        <td class="p-4 text-xs font-medium text-gray-500 whitespace-nowrap dark:text-white">
                        {{ $signup->trx_id }}</td>

                        <td class="p-4 text-xs font-medium text-gray-500 whitespace-nowrap dark:text-white">
                        {{ $signup->trx_id_bkash }}</td>


                    <td class="p-4 text-base font-normal text-gray-900 whitespace-nowrap dark:text-white">
                        {{-- @if ($signup->verified === 'paymentverified')
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-green-400 mr-2"></div>
                                <span class="text-sm">Verified</span>
                            </div>
                        @else
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-yellow-400 mr-2"></div>
                                <span class="text-sm">Not Verified Yet</span>
                            </div>
                        @endif --}}

                        @if ($editPaymentId === $signup->id)
                            <select wire:model="editPaymentStatus" class="rounded-lg select select-bordered">
                                <option value="paymentverified">Verified</option>
                                <option value="notyet">Not Verified yet</option>
                                <option value="invalid">Invalid</option>
                            </select>
                        @else
                            <span
                                class="px-2 py-1 text-sm rounded-lg
                            @if ($signup->verified == 'paymentverified') bg-green-200 text-green-700
                            @elseif($signup->verified == 'notyet') bg-yellow-200 text-yellow-700
                            @else bg-red-200 text-red-700 @endif">
                                {{ ucfirst($signup->verified) }}
                            </span>
                        @endif
                    </td>


                    <td class="p-4 space-x-2 whitespace-nowrap">
                        @if ($editPaymentId === $signup->id)
                            <button type="button" data-modal-toggle="user-modal" wire:click="updatePaymentVerification"
                                class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white rounded-lg bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-600">
                                <svg fill="currentColor" class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                    <path d="M17 0h-5.768a1 1 0 1 0 0 2h3.354L8.4 8.182A1.003 1.003 0 1 0 9.818 9.6L16 3.414v3.354a1 1 0 0 0 2 0V1a1 1 0 0 0-1-1Z"/>
                                    <path d="m14.258 7.985-3.025 3.025A3 3 0 1 1 6.99 6.768l3.026-3.026A3.01 3.01 0 0 1 8.411 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V9.589a3.011 3.011 0 0 1-1.742-1.604Z"/>
                                </svg> Update

                                {{-- Edit user --}}
                            </button>
                            <button type="button" data-modal-toggle="delete-user-modal" wire:click="cancelEdit"
                                class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>Cancel
                            </button>
                        @else
                            <button
                                wire:click="editPaymentVerification({{ $signup->id }}, '{{ $signup->verified }}')"
                                class="px-3 py-1 bg-yellow-500 text-white rounded">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                    </path>
                                    <path fill-rule="evenodd"
                                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
