<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\View\View;

class PropertyController extends Controller
{
    public function index(): View
    {
        $availableProperties = Property::query()
            ->where('status', 'active')
            ->whereDoesntHave('bookings')
            ->latest()
            ->get();

        $bookedProperties = Property::query()
            ->where('status', 'active')
            ->whereHas('bookings')
            ->with(['bookings' => fn ($query) => $query->orderBy('check_in')])
            ->latest()
            ->get();

        return view('properties.index', compact('availableProperties', 'bookedProperties'));
    }
}
