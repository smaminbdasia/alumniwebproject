<div
    class="justify-items-center w-full p-6 mt-5 mb-5 mx-auto bg-white rounded-lg shadow dark:bg-gray-800 sm:max-w-xl lg:col-span-6 sm:p-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="justify-items-center">

            {{-- Steps --}}
            <ol
                class="flex items-center mb-6 text-sm font-medium text-center text-green-700 dark:text-gray-400 lg:mb-12 sm:text-base">
                <li
                    class="flex items-center text-primary-600 dark:text-primary-500 sm:after:content-[''] after:w-12 after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <div
                        class="flex items-center sm:block after:content-['/'] sm:after:hidden after:mx-2 after:font-light after:text-gray-200 dark:after:text-gray-500">
                        <svg class="w-4 h-4 mr-2 sm:mb-2 sm:w-6 sm:h-6 sm:mx-auto" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
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
                        class="flex text-indigo-500 items-center sm:block after:content-['/'] sm:after:hidden after:mx-2 after:font-light after:text-gray-200 dark:after:text-gray-500">
                        <div class="mr-2 sm:mb-2 sm:mx-auto">2</div>
                        Payment <span class="hidden sm:inline-flex">Info</span>
                    </div>
                </li>
                <li class="flex items-center sm:block text-gray-500">
                    <div class="mr-2 sm:mb-2 sm:mx-auto">3</div>
                    Photo <span class="hidden sm:inline-flex">Upload</span>
                </li>
            </ol>


            <div class="flex items-center mx-auto md:w-auto px-4 md:px-8 xl:px-0">

                <div class="max-w-lg mx-auto  rounded">
                    <div>

                        <h2 class="mt-3 mb-2 text-2xl bangla-noto-500 font-medium text-gray-900 dark:text-white">
                            {{ Auth::user()->nameBangla }}
                        </h2>

                        {{-- Divider --}}
                        <div class="flex items-center">
                            <div class="my-3 w-full h-0.5 bg-gray-100 dark:bg-gray-700"></div>
                        </div>
                        <div class="flex items-center">
                            <h2>{{ $event->title }} </h2>

                            <svg class="w-auto h-4 mx-1 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m9 5 7 7-7 7" />
                            </svg>

                            <h2>
                                Registration Fee
                            </h2>
                        </div>
                        {{-- Divider --}}
                        <div class="flex items-center">
                            <div class="my-3 w-full h-0.5 bg-gray-100 dark:bg-gray-700"></div>
                        </div>

                        <!-- Success Message -->
                        @if (session()->has('message'))
                            <div class="bg-green-500 text-white p-3 rounded">{{ session('message') }}</div>
                        @endif

                        {{-- <!-- Tshirt Size -->
                        <x-label class="block mt-3">T-Shirt Size:</x-label>
                        <x-input type="text" class="w-full p-2 border rounded bg-gray-100" value="{{ $tshirt_size }}"
                            disabled /> --}}

                        <!-- Attendance -->
                        <x-label class="block mt-6 bangla-noto-500">রিইউনিয়নে আপনার সম্ভাব্য উপস্থিতি</x-label>
                        <select wire:model="attendance"
                            class="rounded-lg bangla-noto-500 bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected class="bangla-noto-500" value="present">স্বশরীরে উপস্থিত থাকবো, ইনশাআল্লাহ</option>
                            <option class="bangla-noto-500" value="absent">উপস্থিত না থাকার সম্ভাবনা বেশি</option>
                            <option class="bangla-noto-500" value="not_decided">এখনো নিশ্চিত নই</option>
                        </select>

                        @error('attendance')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        <!-- Consent -->
                        <div class="mt-6">
                            <input type="checkbox" wire:model="consent" id="consent" checked>
                            <label for="consent">I give consent to use my profile photo</label>
                        </div>

                        {{-- Divider --}}
                        <div class="flex items-center">
                            <div class="mt-8 mb-4 w-full h-0.5 bg-gray-200 dark:bg-gray-700"></div>
                        </div>


                        <!-- Guest Status -->
                        <x-label class="block mt-6 bangla-noto-500">আপনার সাথে কি কোনো অতিথি আসবেন?</x-label>
                        <select wire:model="guest_status" wire:change="calculateFees"
                            class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <option value="no_guest">No Guest</option>
                            <option value="has_guest">Yes, I will bring guests</option>
                        </select>

                        @if ($guest_status === 'has_guest')

                            <!-- Guest Counts -->
                            <label class="block mt-3 bangla-noto-500">প্রাপ্তবয়স্ক অতিথি সংখ্যা:</label>
                            <input type="number" wire:model="adult_guest_count" wire:change="calculateFees"
                                class="w-full p-2 border rounded-lg" min="0">
                            @error('adult_guest_count')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror

                            <label class="block mt-3 bangla-noto-500">শিশু অতিথি সংখ্যা:</label>
                            <input type="number" wire:model="child_guest_count" wire:change="calculateFees"
                                class="w-full p-2 border rounded-lg" min="0">
                            @error('child_guest_count')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        @endif

                        <div class="mt-6 border border1 rounded-lg">
                            <div class="px-5 py-2">
                                <div class="mt-3 my-2 flex justify-between items-center">
                                    <p class="text-xs">{{ Auth::user()->name }}</p>
                                    <p class="text-xs">ID: <span
                                            class="text-sm font-bold text-indigo-700">{{ Auth::user()->reg_id }}</span>
                                    </p>
                                </div>

                                {{-- Divider --}}
                                <div class="flex items-center">
                                    <div class="my-1 w-full h-0.5 bg-gray-200 dark:bg-gray-700"></div>
                                </div>

                                <!-- Guest Fee Display -->
                                <div class="mt-2 flex items-center justify-between">
                                    <p class="text-base text-gray-500">Total Guest Fee</p>
                                    <p><span class="text-green-900">৳
                                        </span>
                                        <span class="text-xl font-black text-green-900">
                                            {{ number_format($guest_fee ?? 0, 0) }}
                                        </span>
                                    </p>
                                </div>

                                <!-- Reg Fee Display -->
                                <div class="mt-2 flex items-center justify-between">
                                    <p class="text-base text-gray-500">Registration Fee</p>
                                    <p><span class="text-green-900">৳
                                        </span>
                                        <span class="text-base font-black text-gray-600">
                                            {{ number_format(1000) }}
                                        </span>
                                    </p>
                                </div>

                                <!-- bKash Charge Display -->
                                <div class="mt-2 flex items-center justify-between">
                                    <p class="bangla-noto-400 text-gray-500">বিকাশ চার্জ *</p>
                                    <p><span class="text-green-900">৳
                                        </span>
                                        <span class="text-base font-black text-gray-600">
                                            1.5%
                                        </span>
                                    </p>
                                </div>
                            </div>

                            {{-- Divider --}}
                            <div class="flex items-center">
                                <div class="my-1 w-full h-0.5 bg-gray-200 dark:bg-gray-700"></div>
                            </div>
                            <div class="px-5 py-2">

                                <!-- Total Registration Fee -->
                                <div class="mt-2 mb-4 flex items-center justify-between">
                                    <p class="text-base">
                                        <span class="bangla-noto-500"> সর্বমোট পেমেন্ট অ্যামাউন্ট:</span>
                                    </p>
                                    <p>
                                        <span>৳</span>
                                        <span class="text-xl font-black text-indigo-700">
                                            {{ number_format($reg_fee ?? 0, 0) }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <label class="block mt-8 mb-1">Payment Method</label>
                        {{-- <select wire:model="payment_method" wire:change="calculateFees"
                            class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="bankpay">Bank Payment</option>
                            <option value="bkashpay">bKash Payment</option>
                            <option value="cashpay">Cash Payment</option>
                        </select> --}}

                        <div>
                            <ul class=" my-3 grid w-full gap-2 md:grid-cols-2">
                                <li>
                                    <input type="radio" id="bkashpay" name="payment_method" value="bkashpay"
                                        wire:model="payment_method" wire:change="calculateFees" class="hidden peer"
                                        required>
                                    {{-- Add wire:model --}}
                                    <label for="bkashpay"
                                        class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 peer-checked:bg-gray-100 peer-checked:outline-3 peer-checked:outline-offset-2 peer-checked:border-2 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <div class="block">
                                            <div class="w-full text-base font-semibold bangla-noto-600">বিকাশ</div>
                                            <div class="w-full text-sm">Payment Gateway</div>
                                        </div>
                                        <img class="p-1 w-14 h-14" src="{{ asset('image/BKash-Icon-Logo.1.png') }}"
                                            alt="bKash Icon">
                                    </label>
                                </li>

                                <li>
                                    <input type="radio" id="bankpay" name="payment_method" value="bankpay"
                                        wire:model="payment_method" wire:change="calculateFees" class="hidden peer">
                                    <label for="bankpay"
                                        class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 peer-checked:bg-gray-100 peer-checked:outline-3 peer-checked:outline-offset-2 peer-checked:border-2  hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <div class="block">
                                            <div class="w-full text-base font-semibold bangla-noto-600">ব্যাংক</div>
                                            <div class="w-full text-sm">Bank Payment</div>
                                        </div>
                                        <img class="p-1 w-14 h-14"
                                            src="{{ asset('image/Icon - online-payment.png') }}" alt="bKash Icon">
                                    </label>
                                </li>
                                {{-- <li>
                                    <input type="radio" id="cashpay" name="payment_method" value="cashpay"
                                        wire:model="payment_method" wire:change="calculateFees" class="hidden peer">
                                    <label for="cashpay"
                                        class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 peer-checked:bg-gray-100 peer-checked:outline-3 peer-checked:outline-offset-2 peer-checked:border-2  hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <div class="block">
                                            <div class="w-full text-base font-semibold bangla-noto-600">ক্যাশ</div>
                                            <div class="w-full text-sm">Cash Payment</div>
                                        </div>
                                        <img class="p-1 w-14 h-14"
                                            src="{{ asset('image/Icon - Cash Payment 1.png') }}" alt="bKash Icon">
                                    </label>
                                </li> --}}
                            </ul>
                        </div>

                        @error('payment_method')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        @if ($payment_method === 'bankpay')
                            <x-label class="block mt-6">Transaction ID</x-label>
                            <p class="text-xs mb-2 bangla-noto-400 text-gray-400">ভেরিফিকেশনের জন্য ব্যাংকে পেমেন্টের
                                রেফারেন্স আইডি</p>
                            <input type="text" id="trx_id" wire:model="trx_id" class="w-full p-2 border rounded-lg">
                            @error('trx_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        @endif

                        {{-- @if ($payment_method === 'cashpay')
                            <x-label class="block mt-6">Reference</x-label>
                            <p class="text-xs mb-2 bangla-noto-400 text-gray-400">ক্যাশ গ্রহণকারী কর্মকর্তা /
                                প্রতিনিধির নাম</p>
                            <input type="text" wire:model="ref_id" class="w-full p-2 border rounded-lg">
                            @error('ref_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        @endif --}}

                        {{-- <div class="bg-gray-100 p-5 mt-4 text-sm">
                            <p><strong>RECEIPT</strong></p>
                            <p>Guest Status: {{ $guest_status }}</p>
                            <p>Adult Guests: {{ $adult_guest_count }}</p>
                            <p>Child Guests: {{ $child_guest_count }}</p>
                            <p>Guest Fee: {{ $guest_fee }}</p>
                            <p>Total Reg Fee: {{ $reg_fee }}</p>
                        </div> --}}

                        <!-- Submit Button -->
                        <div class="mt-4">
                            @if ($payment_method === 'bkashpay')
                                <button wire:click="submit" wire:loading.attr="disabled"
                                    class="bg-pink-500 text-white px-4 py-2 rounded flex items-center">
                                    <span>
                                        Proceed to Payment
                                    </span>
                                    <svg class="rotate-180 w-3.5 h-3.5 ms-2 text-gray-100 dark:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                                    </svg>
                                </button>
                            @else
                                <button wire:click="submit" wire:loading.attr="disabled"
                                    class="bg-blue-500 text-white px-4 py-2 rounded">
                                    Submit Registration
                                </button>
                            @endif
                        </div>

                        <!-- Loading State -->
                        <div wire:loading class="text-gray-500 mt-2 bangla-noto-500">লোড হচ্ছে... অনুগ্রহ করে অপেক্ষা
                            করুন</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
