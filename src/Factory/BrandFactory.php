<?php

namespace App\Factory;

use App\Entity\Brand;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Brand>
 */
final class BrandFactory extends PersistentObjectFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function class(): string
    {
        return Brand::class;
    }

    protected function defaults(): array
    {
        $brand = self::faker()->randomElement(self::BRANDS_DATA);

        return [
            'name' => $brand['name'],
            'logo' => $brand['logo'],
            'country' => $brand['country'],
        ];
    }

    public const BRANDS_DATA = [
        [
            'name' => 'Renault',
            'logo' => 'logo-renault.png',
            'country' => 'France',
        ],
        [
            'name' => 'Peugeot',
            'logo' => 'logo-peugeot.png',
            'country' => 'France',
        ],
        [
            'name' => 'Dacia',
            'logo' => 'logo-dacia.png',
            'country' => 'Roumanie',
        ],
        [
            'name' => 'Citroën',
            'logo' => 'logo-citroen.png',
            'country' => 'France',
        ],
        [
            'name' => 'Toyota',
            'logo' => 'logo-toyota.png',
            'country' => 'Japon',
        ],
        [
            'name' => 'Volkswagen',
            'logo' => 'logo-volkswagen.png',
            'country' => 'Allemagne',
        ],
        [
            'name' => 'BMW',
            'logo' => 'logo-bmw.png',
            'country' => 'Allemagne',
        ],
        [
            'name' => 'Mercedes',
            'logo' => 'logo-mercedes.png',
            'country' => 'Allemagne',
        ],
        [
            'name' => 'Audi',
            'logo' => 'logo-audi.png',
            'country' => 'Allemagne',
        ],
        [
            'name' => 'Skoda',
            'logo' => 'logo-skoda.png',
            'country' => 'Tchéquie',
        ],
    ];

    public static function createAll(): void
    {
        foreach (self::BRANDS_DATA as $data) {
            self::createOne($data);
        }
    }
}
