<div class=" max-w-8xl mx-auto sm:px-4 lg:px-6">
    <div class="justify-items-center">
        <div>
            <ol
                class="flex items-center mb-6 text-sm font-medium text-center text-gray-500 dark:text-gray-400 lg:mb-12 sm:text-base">
                <li
                    class="flex items-center text-indigo-500 text-primary-600 dark:text-primary-500 sm:after:content-[''] after:w-12 after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <div
                        class="flex items-center sm:block after:content-['/'] sm:after:hidden after:mx-2 after:font-light after:text-gray-200 dark:after:text-gray-500">
                        <div class="mr-2 sm:mb-2 sm:mx-auto">1</div>
                        Profile <span class="hidden sm:inline-flex">Details</span>
                    </div>
                </li>
                <li
                    class="flex items-center after:content-[''] after:w-12 after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <div
                        class="flex items-center sm:block after:content-['/'] sm:after:hidden after:mx-2 after:font-light after:text-gray-200 dark:after:text-gray-500">
                        <div class="mr-2 sm:mb-2 sm:mx-auto">2</div>
                        Payment <span class="hidden sm:inline-flex">Info</span>
                    </div>
                </li>
                <li class="flex items-center sm:block">
                    <div class="mr-2 sm:mb-2 sm:mx-auto">3</div>
                    Photo <span class="hidden sm:inline-flex">Upload</span>
                </li>
            </ol>

        </div>

        <div class="justify-items-center px-12 mx-6">
            {{-- <x-authentication-card-logo /> --}}

            <div class="bangla-noto-500 inline-flex items-center mb-4 text-xl font-semibold text-gray-900 dark:text-white">
                <x-application-logo class="w-8 h-8 mr-6" alt="logo" />
                <span class="ml-4 text-base">বোয়াইলমারী কামিল মাদরাসা অ্যালামনাই অ্যাসোসিয়েশন আয়োজিত পুনর্মিলনী ও
                    সাংস্কৃতিক সন্ধ্যা ২০২৫
                </span>
            </div>
            <h1
                class="mb-2 bangla-noto-800 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white text-green-800">
                নিবন্ধন ফরম
            </h1>
             <a class="bangla-noto-400 text-center underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    {{ __(' আগেই নিবন্ধিত হলে ড্যাশবোর্ডে লগইন করুন') }}
                </a>
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            {{-- <form wire:submit.prevent="register"> --}}
            @csrf



            {{-- Divider --}}
            <div class="flex items-center">
                <div class="mt-6 mb-3 w-full h-0.5 bg-gray-100 dark:bg-gray-700"></div>
            </div>

            <!-- Name -->
            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" placeholder="e.g. Abdullah Al Mahmud" />
                @error('name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>


            <!-- Name in Bangla -->
            <div class="mt-4 bangla-noto-500">
                <x-label for="nameBangla" value="{{ __('পূর্ণনাম (বাংলায়)') }}" />
                <x-input id="nameBangla" class="block mt-1 w-full" type="text" name="nameBangla" :value="old('nameBangla')"
                    autofocus autocomplete="nameBangla" placeholder="উদাহরণ: আব্দুল্লাহ আল মাহমুদ" />
                @error('nameBangla')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Divider -->
            <div class="flex items-center">
                <div class="mt-6 mb-3 w-full h-0.5 bg-gray-100 dark:bg-gray-700"></div>
            </div>

            <!-- Section Header -->
            <div class="mt-3 mb-4 bangla-noto-500 text-base text-cyan-600">টি-শার্ট</div>

            <div class="grid gap-6 sm:grid-cols-2">

                <!-- T-Shirt Size -->

                <div>
                    <x-label for="tshirt_size" value="{{ __('Your T-Shirt Size?') }}" class="" />
                    <select id="tshirt_size" name="tshirt_size"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" disabled {{ old('tshirt_size') ? '' : 'selected' }}>Select a size
                        </option>
                        <option value="XXL" {{ old('tshirt_size') == 'xxl_tshirt' ? 'selected' : '' }}>XXL
                        </option>
                        <option value="XL" {{ old('tshirt_size') == 'xl_tshirt' ? 'selected' : '' }}>XL
                        </option>
                        <option value="L" {{ old('tshirt_size') == 'l_tshirt' ? 'selected' : '' }}>L
                        </option>
                        <option value="M" {{ old('tshirt_size') == 'm_tshirt' ? 'selected' : '' }}>M
                        </option>
                    </select>
                    @error('tshirt_size')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Divider --}}
            <div class="flex items-center">
                <div class="mt-6 mb-3 w-full h-0.5 bg-gray-100 dark:bg-gray-700"></div>
            </div>

            {{-- Section Header --}}
            <div class="mt-3 mb-4 bangla-noto-500 text-base text-cyan-600">পরিচয়</div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="">
                    <x-label for="father" value="{{ __('Father') }}" />
                    <x-input id="father" class="block mt-1 w-full" type="text" name="father" :value="old('father')"
                        autofocus autocomplete="father" placeholder="e.g. Abul Bashar Chowdhury" />
                    @error('father')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="">
                    <x-label for="mother" value="{{ __('Mother') }}" />
                    <x-input id="mother" class="block mt-1 w-full" type="text" name="mother" :value="old('mother')"
                        autofocus autocomplete="mother" placeholder="e.g. Sufia Begum" />
                    @error('mother')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="">
                    <x-label for="birthday" value="{{ __('Date of Birth') }}" />
                    <x-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')"
                        autofocus autocomplete="birthday" max="2015-12-31" />
                    @error('birthday')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="">
                    <x-label for="bloodgroup" value="{{ __('Blood Group') }}" class="" />
                    <select id="bloodgroup" name="bloodgroup"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" disabled {{ old('bloodgroup') ? '' : 'selected' }}>Choose your
                            Blood
                            Group
                        </option>
                        <option value="A+" {{ old('bloodgroup') == 'A+' ? 'selected' : '' }}>A Positive (A+)
                        </option>
                        <option value="A-" {{ old('bloodgroup') == 'A-' ? 'selected' : '' }}>A Negative (A-)
                        </option>
                        <option value="B+" {{ old('bloodgroup') == 'B+' ? 'selected' : '' }}>B Positive (B+)
                        </option>
                        <option value="B-" {{ old('bloodgroup') == 'B-' ? 'selected' : '' }}>B Negative (B-)
                        </option>
                        <option value="AB+" {{ old('bloodgroup') == 'AB+' ? 'selected' : '' }}>AB Positive
                            (AB+)
                        </option>
                        <option value="AB-" {{ old('bloodgroup') == 'AB-' ? 'selected' : '' }}>AB Negative
                            (AB-)
                        </option>
                    </select>
                    @error('bloodgroup')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <x-label for="address" value="{{ __('Address') }}" />
                    <textarea
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        id="address" name="address" class="block mt-1 w-full">{{ old('address') }}</textarea>
                    @error('address')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- District -->
                <div>
                    <x-label for="district" value="{{ __('Home District') }}" />
                    <select id="district" name="district"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @php
                            $districts = [
                                'Dhaka',
                                'Bagerhat',
                                'Bandarban',
                                'Barguna',
                                'Barisal',
                                'Bhola',
                                'Bogra',
                                'Brahmanbaria',
                                'Chandpur',
                                'Chapainawabganj',
                                'Chittagong',
                                'Chuadanga',
                                'Comilla',
                                'Cox\'sBazar',
                                'Dinajpur',
                                'Faridpur',
                                'Feni',
                                'Gaibandha',
                                'Gazipur',
                                'Gopalganj',
                                'Habiganj',
                                'Jaipurhat',
                                'Jamalpur',
                                'Jessore',
                                'Jhalokati',
                                'Jhenaidah',
                                'Khagrachari',
                                'Khulna',
                                'Kishoreganj',
                                'Kurigram',
                                'Kushtia',
                                'Lakshmipur',
                                'Lalmonirhat',
                                'Madaripur',
                                'Magura',
                                'Manikganj',
                                'Maulvibazar',
                                'Meherpur',
                                'Munshiganj',
                                'Mymensingh',
                                'Naogaon',
                                'Narail',
                                'Narayanganj',
                                'Narsingdi',
                                'Natore',
                                'Netrokona',
                                'Nilphamari',
                                'Noakhali',
                                'Pabna',
                                'Panchagarh',
                                'Patuakhali',
                                'Pirojpur',
                                'Rajbari',
                                'Rajshahi',
                                'Rangamati',
                                'Rangpur',
                                'Satkhira',
                                'Shariatpur',
                                'Sherpur',
                                'Sirajganj',
                                'Sunamganj',
                                'Sylhet',
                                'Tangail',
                                'Thakurgaon',
                            ];
                        @endphp

                        @foreach ($districts as $district)
                            <option value="{{ $district }}"
                                {{ old('district', $user->district ?? 'Dhaka') === $district ? 'selected' : '' }}>
                                {{ $district }}
                            </option>
                        @endforeach
                    </select>
                    @error('district')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Divider --}}
            <div class="flex items-center">
                <div class="mt-6 mb-3 w-full h-0.5 bg-gray-100 dark:bg-gray-700"></div>
            </div>

            {{-- Section Header --}}
            <div class="mt-3 mb-4 bangla-noto-500 text-base text-cyan-600">অ্যাকাডেমিক</div>

            <div class="grid gap-6 sm:grid-cols-2">

                <div class="">
                    <x-label for="dakhilBatch" value="{{ __('Dakhil Batch (Passing Year)') }}" />
                    <x-input id="dakhilBatch" class="block mt-1 w-full" type="number" name="dakhilBatch"
                        :value="old('dakhilBatch')" required autofocus min='1901' max='2024' placeholder="e.g. 1996" />
                    @error('dakhilBatch')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="">
                    <x-label for="alimBatch" value="{{ __('Alim Batch (Passing Year)') }}" />
                    <x-input id="alimBatch" class="block mt-1 w-full" type="number" name="alimBatch"
                        :value="old('alimBatch')" required autofocus min='1901' max='2024' placeholder="e.g. 1998" />
                    @error('alimBatch')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            {{-- Divider --}}
            <div class="flex items-center">
                <div class="mt-6 mb-3 w-full h-0.5 bg-gray-100 dark:bg-gray-700"></div>
            </div>

            {{-- Section Header --}}
            <div class="mt-3 mb-4 bangla-noto-500 text-base text-cyan-600">জরুরি তথ্য</div>

            <div class="grid gap-6 sm:grid-cols-2">

                <!-- Mobile Number -->
                <div class="">
                    <x-label for="phone" value="{{ __('Mobile Number (Primary)') }}" />
                    <x-input id="phone" class="block mt-1 w-full" type="tel" name="phone"
                        :value="old('phone')" required autocomplete="tel" placeholder="e.g. 01911222333" />
                    @error('phone')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Secondary Mobile Number -->
                <div class="">
                    <x-label for="phone_2" value="{{ __('Mobile Number (Secondary)') }}" />
                    <x-input id="phone_2" class="block mt-1 w-full" type="tel" name="phone_2"
                        :value="old('phone_2')" autocomplete="tel" placeholder="e.g. 01711222333" />
                    @error('phone_2')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="sm:col-span-2">
                    <x-label for="email" value="{{ __('Email Address (Gmail)') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" placeholder="Your Gmail Address" />
                    @error('email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" placeholder="Min 8 Characters" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password"
                        placeholder="Passwords must match" />
                </div>


                <div class="sm:col-span-2">
                    <span class="bangla-noto-500 text-xs text-yellow-600"> পাসওয়ার্ডটি মনে রাখুন। প্রয়োজনে কোথাও
                        লিখে
                        রাখুন।</span>
                </div>

            </div>

            {{-- Divider --}}
            <div class="flex items-center">
                <div class="mt-6 mb-3 w-full h-0.5 bg-gray-100 dark:bg-gray-700"></div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">


                <x-button class="ms-4">
                    {{ __('Next Page: Payment') }}
                </x-button>
            </div>
        </form>
    </div>
</div>
