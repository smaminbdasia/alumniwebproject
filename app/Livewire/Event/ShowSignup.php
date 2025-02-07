<?php

namespace App\Livewire\Event;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\EventReg;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class ShowSignup extends Component
{
    use WithPagination;

    public $activePage = 'public'; // ✅ Initialize default active page

    public function changePage($page)
    {
        $this->activePage = $page;
    }

    public $search = '';
    public $batchYear = '';
    public $district = '';
    public $event_id = '';

    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination on search
    }

    // public function render()
    // {
    //     $query = EventReg::with(['user', 'event'])
    //         ->when($this->batchYear, function ($query) {
    //             $query->where(function ($q) {
    //                 $q->whereHas('user', function ($q) {
    //                     $q->where('dakhilBatch', $this->batchYear)
    //                         ->orWhere('alimBatch', $this->batchYear);
    //                 });
    //             });
    //         })
    //         ->when($this->district, function ($query) {
    //             $query->whereHas('user', function ($q) {
    //                 $q->where('district', $this->district);
    //             });
    //         })
    //         ->when($this->event_id, function ($query) {
    //             $query->where('event_id', $this->event_id);
    //         })
    //         ->whereHas('user', function ($q) {
    //             $q->where('name', 'like', '%' . $this->search . '%');
    //         })
    //         ->paginate(10);

    //     $events = Event::all();
    //     return view('livewire.event.show-signup', [
    //         'signups' => $query,
    //         'events' => $events
    //     ]);
    // }

    public function render()
    {
        return view('livewire.event.show-signup', [
            'publicSignups' => EventReg::with('user')->paginate(10),
            'managerSignups' => EventReg::with('user')->paginate(10),
            'paymentSignups' => EventReg::paginate(10),
        ])->layout('layouts.app');
    }
}
