<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Property;
use Carbon\Carbon;

class BookingService
{
    private const CLEANING_BUFFER_DAYS = 1;

    public function isAvailable(Property $property, Carbon $checkIn, Carbon $checkOut, ?int $ignoreBookingId = null): bool
    {
        $query = Booking::where('property_id', $property->id)
            ->where('check_in', '<', $checkOut->copy()->addDays(self::CLEANING_BUFFER_DAYS))
            ->where('check_out', '>', $checkIn->copy()->subDays(self::CLEANING_BUFFER_DAYS));

        if ($ignoreBookingId) {
            $query->where('id', '!=', $ignoreBookingId);
        }

        return ! $query->exists();
    }

    public function calculatePrice(Property $property, Carbon $checkIn, Carbon $checkOut): float
    {
        $nights = $checkIn->diffInDays($checkOut);

        return $nights * $property->price_per_night;
    }
}