<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // à affiner plus tard si tu ajoutes de l'auth
    }

    public function rules(): array
    {
        return [
            'property_id'  => ['required', 'exists:properties,id'],
            'guest_name'   => ['required', 'string', 'max:255'],
            'guest_email'  => ['required', 'email', 'max:255'],
            'check_in'     => ['required', 'date', 'after_or_equal:today'],
            'check_out'    => ['required', 'date', 'after:check_in'],
        ];
    }

    public function messages(): array
    {
        return [
            'check_out.after' => 'La date de départ doit être postérieure à la date d\'arrivée.',
            'check_in.after_or_equal' => 'La date d\'arrivée ne peut pas être dans le passé.',
        ];
    }
}