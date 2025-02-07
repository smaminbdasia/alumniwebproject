<?php

namespace App\Livewire\Events;

use Livewire\Component;
use App\Models\Event;

class ShowEvent extends Component
{
    public $events;
    public $selectedEvent = null;

    public function mount()
    {
        // Load events
        $this->events = Event::whereIn('event_status', ['active', 'announced', 'completed'])
            ->orderBy('date', 'asc')
            ->get();
    }

    public function showEvent($eventId)
    {
        // Fetch the event details when clicked
        $this->selectedEvent = Event::find($eventId);
    }

    public function render()
    {
        return view('livewire.events.show-event');
    }
}
