<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propriétés — StayFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 py-10 text-gray-900">
    <main class="mx-auto max-w-6xl space-y-10 px-4">
        <header class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-blue-600">StayFlow</p>
                <h1 class="text-3xl font-bold">Nos propriétés</h1>
                <p class="mt-1 text-gray-600">Consultez les logements disponibles et ceux déjà réservés.</p>
            </div>
            <a href="{{ url('/') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">Accueil</a>
        </header>

        <section>
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-2xl font-semibold">Propriétés disponibles</h2>
                <span class="rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-800">
                    {{ $availableProperties->count() }}
                </span>
            </div>

            @if ($availableProperties->isEmpty())
                <div class="rounded-lg border border-dashed border-gray-300 bg-white p-6 text-center text-gray-500">
                    Aucune propriété n'est disponible pour le moment.
                </div>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($availableProperties as $property)
                        <article class="flex flex-col rounded-lg bg-white p-6 shadow-sm">
                            <div class="flex-1">
                                <div class="mb-2 flex items-start justify-between gap-3">
                                    <h3 class="text-xl font-semibold">{{ $property->title }}</h3>
                                    <span class="whitespace-nowrap rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-800">
                                        Disponible
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500">{{ $property->city }} — {{ $property->address }}</p>
                                <p class="mt-4 text-sm text-gray-600">{{ $property->description }}</p>
                                <p class="mt-4 font-semibold">
                                    {{ number_format($property->price_per_night, 0, ',', ' ') }} Ar
                                    <span class="font-normal text-gray-500">/ nuit · {{ $property->capacity }} voyageurs</span>
                                </p>
                            </div>
                            <a href="{{ route('bookings.create', $property) }}"
                               class="mt-6 rounded bg-blue-600 px-4 py-2 text-center font-medium text-white hover:bg-blue-700">
                                Réserver cette propriété
                            </a>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>

        <section>
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-2xl font-semibold">Propriétés déjà réservées</h2>
                <span class="rounded-full bg-orange-100 px-3 py-1 text-sm font-medium text-orange-800">
                    {{ $bookedProperties->count() }}
                </span>
            </div>

            @if ($bookedProperties->isEmpty())
                <div class="rounded-lg border border-dashed border-gray-300 bg-white p-6 text-center text-gray-500">
                    Aucune propriété n'a encore été réservée.
                </div>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($bookedProperties as $property)
                        <article class="rounded-lg bg-white p-6 shadow-sm">
                            <div class="mb-2 flex items-start justify-between gap-3">
                                <h3 class="text-xl font-semibold">{{ $property->title }}</h3>
                                <span class="whitespace-nowrap rounded-full bg-orange-100 px-2 py-1 text-xs font-medium text-orange-800">
                                    Réservée
                                </span>
                            </div>
                            <p class="text-sm text-gray-500">{{ $property->city }} — {{ $property->address }}</p>
                            <div class="mt-4 space-y-2 text-sm">
                                @foreach ($property->bookings as $booking)
                                    <div class="rounded bg-gray-50 p-3">
                                        <p class="font-medium">{{ $booking->guest_name }}</p>
                                        <p class="text-gray-600">
                                            Du {{ $booking->check_in->format('d/m/Y') }}
                                            au {{ $booking->check_out->format('d/m/Y') }}
                                        </p>
                                        <a href="{{ route('bookings.show', $booking) }}" class="mt-1 inline-block text-blue-600 hover:text-blue-800">
                                            Voir la réservation
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    </main>
</body>
</html>
