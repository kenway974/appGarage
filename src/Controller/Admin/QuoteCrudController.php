<?php

namespace App\Controller\Admin;

use App\Entity\Quote;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class QuoteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Quote::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user'),
            TextField::new('title'),
            ArrayField::new('items'),
            NumberField::new('priceHT')->setNumDecimals(2),
            NumberField::new('priceTTC')->setNumDecimals(2),
            ArrayField::new('pricesHT'),
            ArrayField::new('pricesTTC'),
            NumberField::new('totalHT')->setNumDecimals(2),
            NumberField::new('totalTTC')->setNumDecimals(2),
            DateTimeField::new('validUntil'),
            ChoiceField::new('status')->setChoices([
                'Pending' => 'pending',
                'Accepted' => 'accepted',
                'Refused' => 'refused',
            ]),
            TextareaField::new('notes')->hideOnIndex(),
            DateTimeField::new('createdAt')->hideOnForm(),
        ];
    }
}
