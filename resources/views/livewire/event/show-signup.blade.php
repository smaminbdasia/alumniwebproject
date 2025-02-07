{{-- <x-app-layout> --}}


<div class="p-4">
    <div class="flex space-x-4 mb-4">
        <button wire:click="changePage('public')"
            class="p-2 border {{ $activePage === 'public' ? 'bg-gray-300' : '' }}">নামের তালিকা</button>
        <button wire:click="changePage('manager')"
            class="p-2 border {{ $activePage === 'manager' ? 'bg-gray-300' : '' }}">যোগাযোগের তালিকা</button>
        <button wire:click="changePage('payment')"
            class="p-2 border {{ $activePage === 'payment' ? 'bg-gray-300' : '' }}">পেমেন্ট তালিকা</button>
    </div>

    @if ($activePage === 'public')
        @include('livewire.event.public-signup-table')
    @elseif ($activePage === 'manager')
        @include('livewire.event.manager-signup-table')
    @elseif ($activePage === 'payment')
        @include('livewire.event.payment-signup-table')
    @endif
</div>
@include('livewire.event.signup-table')
<div>

</div>

{{-- </x-app-layout> --}}
