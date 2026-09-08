<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservation confirmée — StayFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-10">
    <div class="max-w-lg mx-auto bg-white rounded-lg shadow p-6">
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 rounded p-3 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-2xl font-bold mb-4">Détails de la réservation</h1>

        <dl class="space-y-2 text-sm">
            <div class="flex justify-between"><dt class="text-gray-500">Logement</dt><dd>{{ $booking->property->title }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Client</dt><dd>{{ $booking->guest_name }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Arrivée</dt><dd>{{ $booking->check_in->format('d/m/Y') }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Départ</dt><dd>{{ $booking->check_out->format('d/m/Y') }}</dd></div>
            <div class="flex justify-between font-semibold border-t pt-2 mt-2">
                <dt>Total</dt><dd>{{ number_format($booking->total_price, 0, ',', ' ') }} Ar</dd>
            </div>
            <div class="flex justify-between"><dt class="text-gray-500">Statut</dt><dd class="capitalize">{{ $booking->status }}</dd></div>
        </dl>
    </div>
</body>
</html>