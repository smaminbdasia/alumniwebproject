<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventReg extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'tshirt_size',
        'attendance',
        'consent',
        'guest_status',
        'adult_guest_count',
        'child_guest_count',
        'guest_fee',
        'payment_method',
        'reg_fee',
        'trx_id',
        'ref_id',
        'trx_id_bkash',
        'verified',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
