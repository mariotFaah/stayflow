<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_booking_with_valid_data(): void
    {
        $user = User::factory()->create();
        $property = Property::factory()->create([
            'user_id' => $user->id,
            'price_per_night' => 150000,
        ]);

       $response = $this->post('/bookings', [
            'property_id' => $property->id,
            'guest_name'  => 'Rakoto Jean',
            'guest_email' => 'rakoto@example.com',
            'check_in'    => now()->addMonth()->format('Y-m-d'),
            'check_out'   => now()->addMonth()->addDays(5)->format('Y-m-d'),
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'property_id' => $property->id,
            'guest_email' => 'rakoto@example.com',
            'total_price' => 750000,
        ]);
        $response->assertRedirect();
        $response->assertSessionDoesntHaveErrors();
    }

    public function test_it_rejects_overlapping_dates(): void
    {
        $user = User::factory()->create();
        $property = Property::factory()->create(['user_id' => $user->id]);

        $property->bookings()->create([
            'guest_name'  => 'Client Existant',
            'guest_email' => 'existant@example.com',
            'check_in'    => '2026-07-10',
            'check_out'   => '2026-07-15',
            'total_price' => 100000,
            'status'      => 'pending',
        ]);

        $response = $this->post('/bookings', [
            'property_id' => $property->id,
            'guest_name'  => 'Nouveau Client',
            'guest_email' => 'nouveau@example.com',
            'check_in'    => '2026-07-12',
            'check_out'   => '2026-07-18',
        ]);

        $response->assertSessionHasErrors('check_in');
        $this->assertDatabaseMissing('bookings', ['guest_email' => 'nouveau@example.com']);
    }
}