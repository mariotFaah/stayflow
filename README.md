# StayFlow

StayFlow est une application web open source de gestion et de réservation de propriétés. Elle permet de consulter les logements disponibles, de voir les propriétés déjà réservées et d'enregistrer une réservation avec ses dates, les informations du client et le prix total.

Le projet est développé avec Laravel et utilise Blade pour les vues HTML.

## Fonctionnalités

- Affichage des propriétés actives disponibles.
- Affichage des propriétés ayant déjà au moins une réservation.
- Affichage des informations principales d'une propriété :
  - titre ;
  - adresse ;
  - ville ;
  - prix par nuit ;
  - capacité ;
  - description.
- Formulaire de réservation d'une propriété.
- Validation des informations du client et des dates.
- Vérification des chevauchements de réservations.
- Application d'un délai de nettoyage d'un jour entre deux réservations.
- Calcul automatique du prix total selon le nombre de nuits.
- Affichage du récapitulatif d'une réservation.

## Technologies utilisées

- PHP 8.3 ou une version supérieure compatible.
- Laravel 13.
- SQLite par défaut, avec possibilité d'utiliser une autre base de données supportée par Laravel.
- Blade.
- Tailwind CSS 4.
- Vite.
- PHPUnit.

## Prérequis

Avant d'installer StayFlow, vérifiez que les outils suivants sont disponibles :

- PHP 8.3 ou supérieur ;
- Composer ;
- Node.js et npm ;
- une base de données SQLite ou une autre base de données compatible avec Laravel.

Vérification des versions :

```bash
php -v
composer -V
node -v
npm -v
```

## Installation

Clonez le dépôt puis entrez dans son répertoire :

```bash
git clone https://github.com/<votre-utilisateur>/stayflow.git
cd stayflow
```

Installez les dépendances PHP et JavaScript :

```bash
composer install
npm install
```

Créez le fichier d'environnement :

```bash
cp .env.example .env
php artisan key:generate
```

Pour utiliser SQLite, créez le fichier de base de données :

```bash
touch database/database.sqlite
```

Vérifiez ensuite les variables `DB_*` dans `.env`. Pour SQLite, la configuration peut utiliser :

```dotenv
DB_CONNECTION=sqlite
DB_DATABASE=/chemin/absolu/vers/stayflow/database/database.sqlite
```

Lancez les migrations :

```bash
php artisan migrate
```

## Lancement en développement

Dans un premier terminal, lancez le serveur Laravel :

```bash
php artisan serve
```

Dans un second terminal, lancez Vite pour compiler les ressources front-end :

```bash
npm run dev
```

L'application est ensuite accessible à l'adresse suivante :

```text
http://127.0.0.1:8000
```

Une commande de développement Laravel est également disponible :

```bash
composer run dev
```

## Routes principales

| Méthode | URL | Nom | Description |
| --- | --- | --- | --- |
| `GET` | `/` | — | Page d'accueil |
| `GET` | `/properties` | `properties.index` | Liste des propriétés disponibles et réservées |
| `GET` | `/properties/{property}/book` | `bookings.create` | Formulaire de réservation |
| `POST` | `/bookings` | `bookings.store` | Création d'une réservation |
| `GET` | `/bookings/{booking}` | `bookings.show` | Affichage du détail d'une réservation |

La page principale du catalogue est disponible ici :

```text
http://127.0.0.1:8000/properties
```

## Structure du projet

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── BookingController.php
│   │   └── PropertyController.php
│   └── Requests/
│       └── StoreBookingRequest.php
├── Models/
│   ├── Booking.php
│   └── Property.php
└── Services/
    └── BookingService.php

resources/views/
├── bookings/
│   ├── create.blade.php
│   └── show.blade.php
└── properties/
    └── index.blade.php

routes/
└── web.php

tests/Feature/
├── BookingStoreTest.php
└── PropertyIndexTest.php
```

## Tests

Lancez toute la suite de tests avec :

```bash
php artisan test
```

Les tests couvrent notamment :

- la création d'une réservation valide ;
- le refus d'une réservation dont les dates se chevauchent ;
- la séparation des propriétés disponibles et réservées dans le catalogue.

Avant de proposer une contribution, vérifiez également le formatage PHP :

```bash
./vendor/bin/pint --test
```

## Contribution

Les contributions sont les bienvenues.

1. Forkez le dépôt.
2. Créez une branche dédiée :

   ```bash
   git checkout -b feature/ma-fonctionnalite
   ```

3. Implémentez votre modification.
4. Ajoutez ou mettez à jour les tests concernés.
5. Vérifiez les tests et le formatage.
6. Créez un commit clair.
7. Ouvrez une pull request en décrivant :
   - le problème résolu ;
   - la solution proposée ;
   - les tests effectués ;
   - les éventuelles limites connues.

Merci de garder les pull requests ciblées et de ne pas inclure de secrets, de fichiers `.env` ou de modifications sans rapport avec le sujet.

## Signaler un problème

Pour signaler un bug ou proposer une amélioration, ouvrez une issue en fournissant :

- une description précise du problème ;
- les étapes pour le reproduire ;
- le comportement attendu ;
- le comportement observé ;
- la version de PHP et de Node.js utilisées ;
- les messages d'erreur pertinents.

## Sécurité

Ne publiez jamais de clés API, mots de passe ou autres informations sensibles dans une issue, une pull request ou le dépôt.

Pour signaler une vulnérabilité de manière responsable, utilisez le mécanisme de signalement privé disponible sur la plateforme d'hébergement du dépôt. Si aucun mécanisme privé n'est configuré, contactez directement les mainteneurs avant toute publication publique.

## Licence

StayFlow est un logiciel open source distribué sous licence MIT. Consultez le fichier `LICENSE` du dépôt pour connaître les conditions complètes d'utilisation, de modification et de redistribution.
