<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'property_id',
    'guest_name',
    'guest_email',
    'check_in',
    'check_out',
    'total_price',
    'status',
])]
class Booking extends Model
{
    use HasFactory;

    protected $casts = [
        'check_in'  => 'date',
        'check_out' => 'date',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}