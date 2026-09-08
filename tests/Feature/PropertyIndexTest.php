<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_displays_available_and_booked_properties_separately(): void
    {
        $user = User::factory()->create();
        $availableProperty = Property::factory()->create([
            'user_id' => $user->id,
            'title' => 'Maison disponible',
        ]);
        $bookedProperty = Property::factory()->create([
            'user_id' => $user->id,
            'title' => 'Appartement réservé',
        ]);

        $bookedProperty->bookings()->create([
            'guest_name' => 'Client Test',
            'guest_email' => 'client@example.com',
            'check_in' => now()->addDay(),
            'check_out' => now()->addDays(4),
            'total_price' => 300000,
            'status' => 'pending',
        ]);

        $response = $this->get(route('properties.index'));

        $response->assertOk()
            ->assertSee('Maison disponible')
            ->assertSee('Appartement réservé')
            ->assertSee('Disponible')
            ->assertSee('Réservée')
            ->assertSee('Client Test');
        $this->assertSame(1, $response->viewData('availableProperties')->count());
        $this->assertSame(1, $response->viewData('bookedProperties')->count());
        $this->assertTrue($response->viewData('availableProperties')->first()->is($availableProperty));
    }
}
