<?php

namespace App\Controller\Admin;

use App\Entity\UserCar;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class UserCarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserCar::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),

            AssociationField::new('user')
                ->setRequired(true)
                ->autocomplete(),

            AssociationField::new('car')
                ->setRequired(true)
                ->autocomplete(),

            TextField::new('plateNumber')->setRequired(true),
            TextField::new('vin')->setRequired(false),
            IntegerField::new('mileage')->setRequired(true),

            DateField::new('purchaseDate')->setRequired(false),
            DateField::new('lastServiceDate')->setRequired(false),

            TextareaField::new('notes')->setRequired(false),

            AssociationField::new('appointments')
                ->hideOnForm() // On ne gère pas les RDV directement ici
        ];
    }
}
