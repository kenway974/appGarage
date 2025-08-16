<?php

namespace App\Factory;

use App\Entity\Service;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentObjectFactory<Service>
 */
final class ServiceFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function class(): string
    {
        return Service::class;
    }

    protected function defaults(): array
    {
        $service = self::faker()->randomElement(self::SERVICES_DATA);

        return [
            'title' => $service['title'],
            'description' => $service['description'],
            'category' => $service['category'],
            'minPrice' => $service['minPrice'],
            'isActive' => $service['isActive'],
        ];
    }

    public const SERVICES_DATA = [
        // 1. Entretien courant
        [
            'title' => 'Vidange moteur (huile + filtre)',
            'description' => 'Remplacement huile moteur et filtre pour assurer la longévité du moteur.',
            'category' => 'Entretien courant',
            'minPrice' => 80,
            'isActive' => true,
        ],
        [
            'title' => 'Remplacement des filtres',
            'description' => 'Filtres à air, habitacle, carburant, huile.',
            'category' => 'Entretien courant',
            'minPrice' => 50,
            'isActive' => true,
        ],
        [
            'title' => 'Révision constructeur',
            'description' => 'Entretien complet selon carnet constructeur.',
            'category' => 'Entretien courant',
            'minPrice' => 150,
            'isActive' => true,
        ],

        // 2. Réparations mécaniques
        [
            'title' => 'Remplacement embrayage',
            'description' => 'Changement du kit complet embrayage (mécanisme, disque, butée).',
            'category' => 'Réparations mécaniques',
            'minPrice' => 600,
            'isActive' => true,
        ],
        [
            'title' => 'Réparation freinage',
            'description' => 'Plaquettes, disques, étriers et liquide de frein.',
            'category' => 'Réparations mécaniques',
            'minPrice' => 200,
            'isActive' => true,
        ],

        // 3. Diagnostic et électronique
        [
            'title' => 'Diagnostic électronique (valise OBD)',
            'description' => 'Lecture et effacement des codes défauts.',
            'category' => 'Diagnostic et électronique',
            'minPrice' => 40,
            'isActive' => true,
        ],

        // 4. Pneumatiques et roues
        [
            'title' => 'Montage pneus',
            'description' => 'Vente et montage pneus été, hiver, 4 saisons.',
            'category' => 'Pneumatiques et roues',
            'minPrice' => 20,
            'isActive' => true,
        ],

        // 5. Carrosserie et vitrage
        [
            'title' => 'Changement pare-brise',
            'description' => 'Remplacement complet pare-brise endommagé.',
            'category' => 'Carrosserie et vitrage',
            'minPrice' => 350,
            'isActive' => true,
        ],

        // 6. Véhicules électriques / hybrides
        [
            'title' => 'Diagnostic batterie haute tension',
            'description' => 'Analyse état batterie VE/Hybride et équilibrage cellules.',
            'category' => 'Électrique / Hybride',
            'minPrice' => 100,
            'isActive' => true,
        ],

        // 7. Amélioration et personnalisation
        [
            'title' => 'Pose attelage',
            'description' => 'Installation d’un attelage homologué.',
            'category' => 'Amélioration & personnalisation',
            'minPrice' => 450,
            'isActive' => true,
        ],

        // 8. Services annexes
        [
            'title' => 'Passage contrôle technique',
            'description' => 'Service relais pour présenter le véhicule au contrôle technique.',
            'category' => 'Services annexes',
            'minPrice' => 90,
            'isActive' => true,
        ],

        // 9. Gestion administrative
        [
            'title' => 'Aide à la carte grise',
            'description' => 'Accompagnement démarches carte grise et immatriculation.',
            'category' => 'Gestion administrative',
            'minPrice' => 40,
            'isActive' => true,
        ],
    ];

    public static function createAll(): void
    {
        foreach (self::SERVICES_DATA as $data) {
            self::createOne($data);
        }
    }
}
