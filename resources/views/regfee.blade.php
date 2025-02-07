<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Payment Method') }}
        </h2>
    </x-slot>

    <div class="bg-white py-24 sm:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base/7 bangla-noto-500 font-semibold text-indigo-600">রেজিস্ট্রেশন ফি</h2>
                <p
                    class="mt-2 bangla-noto-700 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl lg:text-balance">
                    পেমেন্ট প্রক্রিয়া</p>
                <p class="bangla-noto-400 mt-6 text-lg/8 text-gray-600">রেজিস্ট্রেশন ফি ১০০০ টাকা</p>
                <p class="bangla-noto-400 mt-2 text-lg/8 text-gray-600">গেস্ট ফি (যদি থাকে) +
                    বিকাশ
                    চার্জ (প্রযোজ্য ক্ষেত্রে)</p>
                <p class="bangla-noto-400  text-lg/8 text-gray-600">পূর্ণবয়স্ক অতিথিদের ক্ষেত্রে জনপ্রতি ১০০০ টাকা।</p>
                <p class="bangla-noto-400  text-lg/8 text-gray-600"> শিশু অতিথিদের ক্ষেত্রে জনপ্রতি ৫০০ টাকা।</p>

                <div class="mt-2">
                    <button type="button" onclick="window.location.href='{{ route('register') }}'"
                        class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
                        {{ __('Registration Form') }}
                    </button>
                </div>

            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                    <div class="relative pl-16">
                        <dt class="text-base/7 font-semibold text-indigo-600">
                            <div
                                class="absolute top-0 left-0 flex size-10 items-center justify-center rounded-lg bg-white shadow">
                                {{-- <svg class="size-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true" data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg> --}}
                                <img class="p-1" src="{{ 'image/BKash-Icon-Logo.1.png' }}" alt="">
                            </div>
                            <span class="bangla-noto-700">বিকাশ পেমেন্ট গেটওয়ে</span>
                        </dt>
                        <dd class="mt-2 text-base/7 text-gray-600"><span class="bangla-noto-500">রেজিস্ট্রেশন ফরমের ২য় ধাপে বিকাশ পেমেন্ট গেটওয়ের মাধ্যমে আপনি আপনার রেজিস্ট্রেশন ফি পেমেন্ট করতে পারবেন।
                            </span></dd>
                    </div>
                    <div class="relative pl-16">
                        <dt class="text-base/7 font-semibold text-indigo-600">
                            <div
                                class="absolute top-0 left-0 flex size-12 items-center justify-center rounded-lg bg-white shadow">
                                <img class="" src="{{ 'image/Icon-Card-Payment-1.jpg' }}" alt="">
                            </div>
                            <span class="bangla-noto-700">ব্যাংক পেমেন্ট</span>
                        </dt>
                        <dd class="mt-2 text-base/7 text-gray-600">
                            <p class="mb-3 bangla-noto-500 text-base text-gray-700 dark:text-gray-400">নিচের ব্যাংক অ্যাকাউন্টে অনলাইনে বা অফলাইনে পেমেন্ট করতে পারবেন। তবে পেমেন্টের আগে অবশ্যই আপনার অতিথি ফি যোগ করে কত টাকা হতে পারে তা দেখে নিন। ব্যাংক পেমেন্টের ক্ষেত্রে রেজিস্ট্রেশন ফরমে আপনার ব্যাংক লেনদেনের TRX ID টি ঠিকভাবে উল্লেখ করতে হবে। </p>
                            <p class="mb-3 bangla-noto-500 text-base text-gray-700 dark:text-gray-400">
                                AC Name: হানিফ এন্টারপ্রাইজ / Hanif Enterprise <br>
                                AC No: 20502440100259215 <br>
                                Bank: ইসলামী ব্যাংক লিমিটেড <br>
                                Branch: সাঁথিয়া শাখা,পাবনা।</p>
                        </dd>
                    </div>
                </dl>
            </div>


        </div>
    </div>



</x-guest-layout>
