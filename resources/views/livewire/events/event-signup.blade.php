<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg">
    @if ($existingSignup)
        <div class="text-center">
            <h2 class="text-xl font-semibold text-green-600">✅ You have already registered for the Reunion 2025</h2>


            <div class="mt-6 space-y-2">

                <div class="my-3 flex justify-center">
                    <img class="my-4 w-36 h-36 rounded-lg" src="{{ Auth::user()->profile_photo_url }}"
                    alt="{{ Auth::user()->name }}" />
                </div>

                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Phone:</strong> {{ Auth::user()->phone }}</p>
                <p><strong>T-shirt Size:</strong> {{ $existingSignup->tshirt_size }}</p>
                <br>

                <p><strong>Payment Method:</strong> {{ ucfirst($existingSignup->payment_method) }}</p>

                <div class="flex justify-center">
                    <div class="mt-6 border border1 rounded-lg">
                        <div class="px-5 py-2">
                            <div class="mt-3 my-2 gap-6 flex justify-between items-center">
                                <p class="text-xs">{{ Auth::user()->name }}</p>
                                <p class="text-xs">ID: <span
                                        class="text-sm font-bold text-indigo-700">{{ Auth::user()->reg_id }}</span>
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

                            {{-- Divider --}}
                            <div class="flex items-center">
                                <div class="my-1 w-full h-0.5 bg-gray-200 dark:bg-gray-700"></div>
                            </div>



                            <!-- Reg Fee Display -->
                            <div class="mt-2 flex items-center justify-between">
                                <p class="bangla-noto-400 text-gray-500">পূর্ণবয়স্ক অতিথি</p>
                                <p>
                                    <span class="text-base font-black text-gray-600">
                                        {{ ucfirst($existingSignup->adult_guest_count) }}
                                    </span>
                                </p>
                            </div>

                            <!-- bKash Charge Display -->
                            <div class="mt-2 flex items-center justify-between">
                                <p class="bangla-noto-400 text-gray-500">শিশু অতিথি</p>
                                <p>
                                    <span class="text-base font-black text-gray-600">
                                        {{ ucfirst($existingSignup->child_guest_count) }}
                                    </span>
                                </p>
                            </div>

                            <!-- Guest Fee Display -->
                            <div class="mt-2 flex items-center justify-between">
                                <p class="text-base text-gray-500">Total Guest Fee</p>
                                <p><span class="text-green-900">৳
                                    </span>
                                    <span class="text-xl font-black text-green-900">
                                        {{ ucfirst($existingSignup->guest_fee) }}
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
                                <p class="ms-4">
                                    <span>৳</span>
                                    <span class="text-xl font-black text-indigo-700">
                                        {{ number_format($existingSignup->reg_fee, 2) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <div class="mt-3">
                <p><strong>Payment Verification</strong> {{ $existingSignup->verified }}</p>
            </div>

            <div class="mt-6 mb-12">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md">Go to
                    Dashboard</a>
            </div>
        </div>
    @else
        <!-- Show the signup form if the user hasn't registered -->
        @include('livewire.event.signup-form')
    @endif
</div>
