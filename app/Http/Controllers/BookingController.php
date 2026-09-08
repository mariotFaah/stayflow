<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Property;
use App\Services\BookingService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;

class BookingController extends Controller
{
    public function __construct(
        private BookingService $bookingService
    ) {}

    public function store(StoreBookingRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $property = Property::findOrFail($validated['property_id']);
        $checkIn = Carbon::parse($validated['check_in']);
        $checkOut = Carbon::parse($validated['check_out']);

        if (! $this->bookingService->isAvailable($property, $checkIn, $checkOut)) {
            return back()
                ->withInput()
                ->withErrors(['check_in' => 'Ces dates ne sont pas disponibles pour cette propriété.']);
        }

        $totalPrice = $this->bookingService->calculatePrice($property, $checkIn, $checkOut);

        $booking = Booking::create([
            'property_id'  => $property->id,
            'guest_name'   => $validated['guest_name'],
            'guest_email'  => $validated['guest_email'],
            'check_in'     => $checkIn,
            'check_out'    => $checkOut,
            'total_price'  => $totalPrice,
            'status'       => 'pending',
        ]);

        return redirect()
            ->route('bookings.show', $booking)
            ->with('success', 'Réservation créée avec succès !');
    }

    public function show(Booking $booking): \Illuminate\View\View
    {
        return view('bookings.show', compact('booking'));
    }

    public function create(Property $property): \Illuminate\View\View
    {
        return view('bookings.create', compact('property'));
    }
}