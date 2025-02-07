@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10">
        @livewire('event-signup', ['event' => $event])
    </div>
@endsection
