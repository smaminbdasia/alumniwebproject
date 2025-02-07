<?php

namespace App\Livewire\Events;

// use Illuminate\Support\Str;
use App\Models\Event;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; // ✅ Import this

class CreateEvent extends Component
{
    use WithFileUploads;

    public $title, $title_bangla, $slug, $type = 'public', $date, $reg_fee = 0;
    public $adult_guest_fee = 0, $child_guest_fee = 0, $cover_photo, $description, $event_status = 'active';

    public $editing = false; // To track whether we're editing an event
    public $eventId; // To hold the event id for editing


    protected function rules()
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'title_bangla' => 'nullable|string|min:3|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('events', 'slug')->ignore($this->eventId)], // ✅ Allow same slug for existing event
            'type' => 'required|in:public,private',
            'date' => 'required|date|after_or_equal:2024-01-01',
            'reg_fee' => 'nullable|integer|min:0',
            'adult_guest_fee' => 'nullable|integer|min:0',
            'child_guest_fee' => 'nullable|integer|min:0',
            'cover_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string|max:500',
            'event_status' => 'required|in:active,completed,announced,draft',
        ];
    }


    public function mount()
    {
        if (Auth::guest() || !in_array(Auth::user()->role, ['admin', 'manager'])) {
            abort(403, 'Unauthorized access.');
        }
    }

    protected $messages = [
        'email.required' => 'The Email Address cannot be empty.',
        'email.email' => 'The Email Address format is not valid.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function save()
    {
        $this->validate();

        $coverPhotoPath = null; // Prevent undefined variable issue

        if ($this->editing) {
            // ✅ Find and update the existing event
            $event = Event::find($this->eventId);
            $event->update([
                'title' => $this->title,
                'title_bangla' => $this->title_bangla,
                'slug' => $this->slug,
                'type' => $this->type,
                'date' => $this->date,
                'reg_fee' => $this->reg_fee,
                'adult_guest_fee' => $this->adult_guest_fee,
                'child_guest_fee' => $this->child_guest_fee,
                'description' => $this->description,
                'event_status' => $this->event_status,
            ]);
        } else {
            // ✅ Store the created event in $event
            $event = Event::create([
                'title' => $this->title,
                'title_bangla' => $this->title_bangla,
                'slug' => $this->slug,
                'type' => $this->type,
                'date' => $this->date,
                'reg_fee' => $this->reg_fee,
                'adult_guest_fee' => $this->adult_guest_fee,
                'child_guest_fee' => $this->child_guest_fee,
                'description' => $this->description,
                'event_status' => $this->event_status,
            ]);
        }

        /// ✅ Handle cover photo (AFTER event is created so we have an ID)
        if ($this->cover_photo) {
            $extension = $this->cover_photo->getClientOriginalExtension();
            $filename = "Cover_Photo_{$event->id}_{$event->slug}_" . time() . ".{$extension}";
            $coverPhotoPath = $this->cover_photo->storeAs('cover_photos', $filename, 'public');

            // ✅ Update the event with the new cover photo path
            $event->update(['cover_photo' => $coverPhotoPath]);
        }


        session()->flash('message', $this->editing ? 'Event Updated Successfully!' : 'Event Created Successfully!');
        $this->reset();
    }


    public function edit($eventId)
    {
        $event = Event::find($eventId);
        $this->eventId = $event->id;
        $this->title = $event->title;
        $this->title_bangla = $event->title_bangla;
        $this->slug = $event->slug;
        $this->type = $event->type;
        $this->date = $event->date;
        $this->reg_fee = $event->reg_fee;
        $this->adult_guest_fee = $event->adult_guest_fee;
        $this->child_guest_fee = $event->child_guest_fee;
        $this->cover_photo = null; // When editing, the existing cover photo won't be overwritten until updated
        $this->description = $event->description;
        $this->event_status = $event->event_status;
        $this->editing = true; // Enable editing
    }


    public function confirmDelete($id)
    {
        $this->dispatch('confirm-delete', $id);
    }

        public function deleteEvent($id)
    {
        Event::findOrFail($id)->delete();
        session()->flash('message', 'Event deleted successfully!');
    }

    protected $listeners = ['deleteEvent'];



    public function render()
    {
        return view('livewire.events.create-event', [
            'events' => Event::latest()->get(), // Fetch all events and pass them to the view
        ])->layout('layouts.app');
    }
}
