<?php

namespace App\Factory;

use App\Entity\Piece;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Piece>
 */
final class PieceFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function class(): string
    {
        return Piece::class;
    }

    protected function defaults(): array
    {
        $piece = self::faker()->randomElement(self::PIECES_DATA);

        return [
            'name' => $piece['name'],
            'reference' => $piece['reference'] ?? null,
            'description' => $piece['description'] ?? null,
            'minPrice' => $piece['minPrice'] ?? self::faker()->randomFloat(2, 10, 500),
            'quantity' => $piece['quantity'] ?? self::faker()->numberBetween(1, 50),
            'category' => $piece['category'] ?? null,
            'image' => $piece['image'] ?? null,
            'updatedAt' => new \DateTime(),
        ];
    }

    public const PIECES_DATA = [
        [
            'name' => 'Filtre à huile',
            'reference' => 'FO-123',
            'description' => 'Filtre à huile compatible avec plusieurs modèles de voitures.',
            'minPrice' => 12.99,
            'quantity' => 50,
            'category' => 'Entretien',
            'image' => 'filter_oil.jpg',
        ],
        [
            'name' => 'Plaquettes de frein avant',
            'reference' => 'PF-456',
            'description' => 'Plaquettes de frein pour voitures compactes.',
            'minPrice' => 45.00,
            'quantity' => 30,
            'category' => 'Freinage',
            'image' => 'brake_front.jpg',
        ],
        [
            'name' => 'Bougie d’allumage',
            'reference' => 'BA-789',
            'description' => 'Bougie haute performance pour moteurs essence.',
            'minPrice' => 9.50,
            'quantity' => 100,
            'category' => 'Allumage',
            'image' => 'spark_plug.jpg',
        ],
        [
            'name' => 'Filtre à air',
            'reference' => 'FA-321',
            'description' => 'Filtre à air pour moteurs essence et diesel.',
            'minPrice' => 15.00,
            'quantity' => 70,
            'category' => 'Entretien',
            'image' => 'air_filter.jpg',
        ],
        [
            'name' => 'Amortisseur arrière',
            'reference' => 'AR-654',
            'description' => 'Amortisseur arrière pour voitures familiales.',
            'minPrice' => 89.99,
            'quantity' => 20,
            'category' => 'Suspension',
            'image' => 'shock_rear.jpg',
        ],
        [
            'name' => 'Courroie de distribution',
            'reference' => 'CD-987',
            'description' => 'Courroie de distribution résistante et durable.',
            'minPrice' => 120.00,
            'quantity' => 15,
            'category' => 'Moteur',
            'image' => 'timing_belt.jpg',
        ],
        [
            'name' => 'Batterie 12V',
            'reference' => 'BAT-112',
            'description' => 'Batterie longue durée compatible avec la majorité des voitures.',
            'minPrice' => 99.90,
            'quantity' => 25,
            'category' => 'Électrique',
            'image' => 'battery.jpg',
        ],
        [
            'name' => 'Alternateur',
            'reference' => 'ALT-334',
            'description' => 'Alternateur pour moteurs essence et diesel.',
            'minPrice' => 150.00,
            'quantity' => 10,
            'category' => 'Électrique',
            'image' => 'alternator.jpg',
        ],
        [
            'name' => 'Pompe à eau',
            'reference' => 'PW-556',
            'description' => 'Pompe à eau haute performance pour refroidissement moteur.',
            'minPrice' => 65.00,
            'quantity' => 18,
            'category' => 'Refroidissement',
            'image' => 'water_pump.jpg',
        ],
        [
            'name' => 'Étrier de frein',
            'reference' => 'EF-778',
            'description' => 'Étrier de frein avant pour voitures sportives.',
            'minPrice' => 200.00,
            'quantity' => 8,
            'category' => 'Freinage',
            'image' => 'brake_caliper.jpg',
        ],
        // tu peux continuer à ajouter autant de pièces que tu veux ici
    ];

    public static function createAll(): void
    {
        foreach (self::PIECES_DATA as $data) {
            self::createOne($data);
        }
    }
}
