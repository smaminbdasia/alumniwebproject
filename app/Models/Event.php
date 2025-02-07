<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_bangla',
        'slug',
        'type',
        'date',
        'reg_fee',
        'adult_guest_fee',
        'child_guest_fee',
        'cover_photo',
        'description',
        'event_status',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
