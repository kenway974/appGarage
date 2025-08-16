<?php

namespace App\Factory;

use App\Entity\Car;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Car>
 */
final class CarFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function class(): string
    {
        return Car::class;
    }

    protected function defaults(): array
    {
        $car = self::faker()->randomElement(self::CARS_DATA);

        return [
            'name' => $car['name'],
            'image' => $car['image'],
            'updatedAt' => self::faker()->dateTimeThisYear(),
        ];
    }

    public const CARS_DATA = [
        [
            'name' => '208',
            'image' => 'https://www.peugeot.fr/content/dam/peugeot/france/vehicules/208/208-2023/peugeot-208-2023-1.jpg',
        ],
        [
            'name' => '206',
            'image' => 'https://www.peugeot.fr/content/dam/peugeot/france/vehicules/208/208-2023/peugeot-208-2023-1.jpg',
        ],
        [
            'name' => '207',
            'image' => 'https://www.peugeot.fr/content/dam/peugeot/france/vehicules/208/208-2023/peugeot-208-2023-1.jpg',
        ],
        [
            'name' => '308',
            'image' => 'https://www.peugeot.fr/content/dam/peugeot/france/vehicules/208/208-2023/peugeot-208-2023-1.jpg',
        ],
        [
            'name' => '307',
            'image' => 'https://www.peugeot.fr/content/dam/peugeot/france/vehicules/208/208-2023/peugeot-208-2023-1.jpg',
        ],
        [
            'name' => '308',
            'image' => 'https://www.peugeot.fr/content/dam/peugeot/france/vehicules/308/308-2023/peugeot-308-2023-1.jpg',
        ],
        [
            'name' => '2008',
            'image' => 'https://www.peugeot.fr/content/dam/peugeot/france/vehicules/2008/2008-2023/peugeot-2008-2023-1.jpg',
        ],
        [
            'name' => '3008',
            'image' => 'https://www.peugeot.fr/content/dam/peugeot/france/vehicules/3008/3008-2023/peugeot-3008-2023-1.jpg',
        ],
        [
            'name' => 'Clio',
            'image' => 'https://www.renault.fr/content/dam/renault/france/vehicules/clio/clio-2023/clio-2023-1.jpg',
        ],
        [
            'name' => 'Megane',
            'image' => 'https://www.renault.fr/content/dam/renault/france/vehicules/clio/clio-2023/clio-2023-1.jpg',
        ],
        [
            'name' => 'Laguna',
            'image' => 'https://www.renault.fr/content/dam/renault/france/vehicules/clio/clio-2023/clio-2023-1.jpg',
        ],
        [
            'name' => 'Kadjar',
            'image' => 'https://www.renault.fr/content/dam/renault/france/vehicules/clio/clio-2023/clio-2023-1.jpg',
        ],
        [
            'name' => 'Captur',
            'image' => 'https://www.renault.fr/content/dam/renault/france/vehicules/captur/captur-2023/captur-2023-1.jpg',
        ],
        [
            'name' => 'Kangoo',
            'image' => 'https://www.renault.fr/content/dam/renault/france/vehicules/captur/captur-2023/captur-2023-1.jpg',
        ],
        [
            'name' => 'C2',
            'image' => 'https://www.citroen.fr/content/dam/citroen/france/vehicules/c3/c3-2023/c3-2023-1.jpg',
        ],
        [
            'name' => 'C3',
            'image' => 'https://www.citroen.fr/content/dam/citroen/france/vehicules/c3/c3-2023/c3-2023-1.jpg',
        ],
        [
            'name' => 'C4',
            'image' => 'https://www.citroen.fr/content/dam/citroen/france/vehicules/c3/c3-2023/c3-2023-1.jpg',
        ],
        [
            'name' => 'C1',
            'image' => 'https://www.citroen.fr/content/dam/citroen/france/vehicules/c3/c3-2023/c3-2023-1.jpg',
        ],
        [
            'name' => 'C15',
            'image' => 'https://www.citroen.fr/content/dam/citroen/france/vehicules/c3/c3-2023/c3-2023-1.jpg',
        ],
        [
            'name' => 'Duster',
            'image' => 'https://www.dacia.fr/content/dam/dacia/france/vehicules/duster/duster-2023/duster-2023-1.jpg',
        ],
        [
            'name' => 'Sandero',
            'image' => 'https://www.dacia.fr/content/dam/dacia/france/vehicules/sandero/sandero-2023/sandero-2023-1.jpg',
        ],
        [
            'name' => 'Logane',
            'image' => 'https://www.dacia.fr/content/dam/dacia/france/vehicules/sandero/sandero-2023/sandero-2023-1.jpg',
        ],
        [
            'name' => 'Yaris',
            'image' => 'https://www.toyota.fr/content/dam/toyota/france/vehicules/yaris-cross/yaris-cross-2023/yaris-cross-2023-1.jpg',
        ],
        [
            'name' => 'Corolla',
            'image' => 'https://www.toyota.fr/content/dam/toyota/france/vehicules/yaris-cross/yaris-cross-2023/yaris-cross-2023-1.jpg',
        ]
    ];

    public static function createAll(): void
    {
        foreach (self::CARS_DATA as $data) {
            self::createOne($data);
        }
    }
}
