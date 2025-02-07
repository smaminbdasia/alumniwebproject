<?php

namespace App\Livewire\Event;

use Livewire\Component;
use App\Models\Event;
use App\Models\EventReg;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class EventSignup extends Component
{
    public $event;
    public $tshirt_size;
    public $attendance = 'present';
    public $consent = true;
    public $guest_status = 'no_guest';
    public $adult_guest_count = 0;
    public $child_guest_count = 0;
    public $guest_fee = 0;
    public $payment_method = 'bkashpay';
    public $reg_fee = 0;
    public $trx_id;
    public $ref_id;
    public $trx_id_bkash;
    public $verified = 'notyet';

    protected $rules = [
        'attendance' => 'required|in:present,absent,not_decided',
        'consent' => 'boolean',
        'guest_status' => 'required|in:has_guest,no_guest',
        'adult_guest_count' => 'required|integer|min:0',
        'child_guest_count' => 'required|integer|min:0',
        'guest_fee' => 'required|integer|min:0',
        'payment_method' => 'required|in:bankpay,bkashpay,cashpay',
        'reg_fee' => 'required|integer|min:0',
        'trx_id' => 'nullable|required_if:payment_method,bankpay|string|unique:event_regs,trx_id',
        'ref_id' => 'nullable|required_if:payment_method,cashpay|string',
        'trx_id_bkash' => 'nullable|string',
        'verified' => 'nullable|in:paymentverified,invalid,notyet',
    ];

    public $existingSignup;

    public function mount(Event $event = null)
    {
        if (!$event) {
            abort(404, 'There is no active event right now.');
        }

        $this->event = $event;

        if (!Auth::check()) {
            return Redirect::route('login')->with('error', 'Please log in to continue.');
        }

        // Check if user already signed up
        $this->existingSignup = EventReg::where('user_id', Auth::id())
            ->where('event_id', $this->event->id)
            ->first();

        if ($this->existingSignup) {
            return; // Prevents loading default form values if already registered
        }

        $this->tshirt_size = Auth::user()->tshirt_size;
        $this->calculateFees();
    }

    public function updated($field)
    {
        if (in_array($field, ['adult_guest_count', 'child_guest_count', 'guest_status', 'payment_method'])) {
            $this->calculateFees();
        }
    }

    public function calculateFees()
    {
        if ($this->guest_status === 'has_guest') {
            $this->guest_fee = ($this->adult_guest_count * $this->event->adult_guest_fee) +
                ($this->child_guest_count * $this->event->child_guest_fee);
        } else {
            $this->guest_fee = 0;
        }

        $base_fee = $this->event->reg_fee + $this->guest_fee;

        // Apply bKash fee only if payment method is bkashpay
        if ($this->payment_method === 'bkashpay') {
            $this->reg_fee = $base_fee + ($base_fee * 0.015);
        } else {
            $this->reg_fee = $base_fee;
        }
    }


    public function submit()
    {
        $this->validate();

        // Ensure reg_fee is calculated before submitting
        $this->calculateFees(); // Recalculate in case there were any changes

        if ($this->payment_method === 'bkashpay') {
            return $this->redirectToBkashGateway();
        }

        $this->storeRegistration();
    }

    public function redirectToBkashGateway()
    {
        // Store form data in session
        session()->put('event_signup_data', [
            'attendance' => $this->attendance,
            'consent' => $this->consent,
            'guest_status' => $this->guest_status,
            'adult_guest_count' => $this->adult_guest_count,
            'child_guest_count' => $this->child_guest_count,
            'guest_fee' => $this->guest_fee,
            'payment_method' => $this->payment_method,
            'reg_fee' => $this->reg_fee,
            'trx_id' => $this->trx_id,
            'ref_id' => $this->ref_id,
            'verified' => $this->verified,
        ]);

        // Debugging line
        // dd(session()->get('event_signup_data')); // Check if data is stored in session

        return redirect()->route('bkash-create-payment', [
            'amount' => $this->reg_fee,  // Payment amount
            'user_id' => Auth::id(), // Pass user ID to track the user
            'event_id' => $this->event->id, // 🛠 Ensure event ID is sent
        ]);
    }

    public function storeRegistration($bkash_trx_id = null)
    {
        // Debugging: Check if form data is present
        if (!session()->has('event_signup_data')) {
            dd('Form data is missing in session.');
        }

        // Retrieve form data from session
        $formData = session()->get('event_signup_data');

        // Debugging: Check if attendance is set
        if (empty($formData['attendance'])) {
            dd('Attendance is not set.', $formData);
        }

        EventReg::create([
            'user_id' => Auth::id(),
            'event_id' => $this->event->id,
            'tshirt_size' => Auth::user()->tshirt_size,
            'attendance' => $formData['attendance'],
            'consent' => $formData['consent'],
            'guest_status' => $formData['guest_status'],
            'adult_guest_count' => $formData['adult_guest_count'],
            'child_guest_count' => $formData['child_guest_count'],
            'guest_fee' => $formData['guest_fee'],
            'payment_method' => $formData['payment_method'],
            'reg_fee' => $formData['reg_fee'],
            'trx_id' => $formData['trx_id'],
            'ref_id' => $formData['ref_id'],
            'trx_id_bkash' => $bkash_trx_id,
            'verified' => $formData['verified'],
        ]);

        // Clear the session data after use
        session()->forget('event_signup_data');

        session()->flash('message', 'Registration successful!');
        return redirect()->route('dashboard');
    }


    public function render()
    {
        return view('livewire.events.event-signup')->layout('layouts.app');
    }
}
