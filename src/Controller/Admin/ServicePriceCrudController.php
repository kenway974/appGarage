<?php

namespace App\Controller\Admin;

use App\Entity\ServicePrice;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class ServicePriceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ServicePrice::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('price', 'Prix'),
            AssociationField::new('services'),
            AssociationField::new('Car', 'Voitures'),
            AssociationField::new('pieces', 'Pièces'),
            AssociationField::new('appointments', 'Rendez-vous'),
        ];
    }
}
