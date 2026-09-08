<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réserver {{ $property->title }} — StayFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-10">
    <div class="max-w-lg mx-auto bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-1">{{ $property->title }}</h1>
        <p class="text-gray-500 mb-4">{{ $property->city }} — {{ number_format($property->price_per_night, 0, ',', ' ') }} Ar / nuit</p>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded p-3 mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('bookings.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="property_id" value="{{ $property->id }}">

            <div>
                <label class="block text-sm font-medium mb-1">Nom</label>
                <input type="text" name="guest_name" value="{{ old('guest_name') }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="guest_email" value="{{ old('guest_email') }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Arrivée</label>
                    <input type="date" name="check_in" value="{{ old('check_in') }}"
                           class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Départ</label>
                    <input type="date" name="check_out" value="{{ old('check_out') }}"
                           class="w-full border rounded px-3 py-2" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white rounded py-2 font-medium hover:bg-blue-700">
                Réserver
            </button>
        </form>
    </div>
</body>
</html>