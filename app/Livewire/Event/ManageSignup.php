<?php

namespace App\Livewire\Event;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\EventReg;
use App\Models\Event;
use App\Models\User;
// use Illuminate\Support\Facades\Auth;

class ManageSignup extends Component
{
    use WithPagination;

    public $eventId; // Store event ID
    public $eventSlug; // To store event slug

    public $search = '';
    public $batchFilter = '';
    public $paymentStatusFilter = ''; // Default empty (shows all)


    public $sortField = 'name'; // Default sort column
    public $sortDirection = 'asc'; // Default sort order

    public $editPaymentId = null; // Holds the ID of the record being edited
    public $editPaymentStatus = ''; // Holds the updated status

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function mount($eventSlug)
    {
        $event = Event::where('slug', $eventSlug)->firstOrFail();
        $this->eventId = $event->id;
        $this->eventSlug = $eventSlug;
    }

    public function getBatchesProperty()
    {
        // Fetch distinct batch values for this event
        return User::whereHas('eventRegs', function ($query) {
            $query->where('event_id', $this->eventId);
        })->select('dakhilBatch')->distinct()->pluck('dakhilBatch');
    }

    public function updatedBatchFilter()
    {
        $this->resetPage(); // Reset pagination when batch changes
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Resets pagination when search input changes
    }

    public function applyFilters()
    {
        $this->resetPage(); // Reset pagination when applying new filters
    }

    public function editPaymentVerification($id, $currentStatus)
    {
        $this->editPaymentId = $id;
        $this->editPaymentStatus = $currentStatus;
    }

    public function updatePaymentVerification()
    {
        if ($this->editPaymentId) {
            EventReg::where('id', $this->editPaymentId)->update([
                'verified' => $this->editPaymentStatus,
            ]);
            $this->editPaymentId = null;
            $this->editPaymentStatus = '';
        }
    }

    public function cancelEdit()
    {
        $this->editPaymentId = null;
        $this->editPaymentStatus = '';
    }

    public function render()
    {
        // Perform your query using $this->eventSlug
        $event = Event::where('slug', $this->eventSlug)->first();

        $query = EventReg::query()
            ->with(['user', 'event'])
            ->where('event_id', $this->eventId);  // Now uses the event ID from slug

        if (!empty($this->search)) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('father', 'like', '%' . $this->search . '%')
                    ->orWhere('reg_id', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%')
                    ->orWhere('district', 'like', '%' . $this->search . '%');
            });
        }

        if (!empty($this->batchFilter)) {
            $query->whereHas('user', function ($q) {
                $q->where('dakhilBatch', $this->batchFilter);
            });
        }

        if (!empty($this->paymentStatusFilter)) {
            $query->where('verified', $this->paymentStatusFilter);
        }


        // Handle sorting for related fields
        if (in_array($this->sortField, ['reg_id', 'name', 'father', 'district'])) {
            $query->join('users', 'event_regs.user_id', '=', 'users.id')
                ->orderBy("users.$this->sortField", $this->sortDirection)
                ->select('event_regs.*'); // Avoid column conflicts
        } else {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        // Perform your query using $this->eventSlug
        $event = Event::where('slug', $this->eventSlug)->first();

        // dd($query->toSql(), $query->getBindings()); // Debug SQL query

        return view('livewire.event.manage-signup', [
            'signups' => $query->paginate(15),
            'batches' => $this->batches,
        ])->layout('layouts.app');
    }
}
