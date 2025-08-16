<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityManagerInterface;

class CarCrudController extends AbstractCrudController
{
    private AdminUrlGenerator $adminUrlGenerator;
    private EntityManagerInterface $em;

    public function __construct(AdminUrlGenerator $adminUrlGenerator, EntityManagerInterface $em)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
        $this->em = $em;
    }

    public static function getEntityFqcn(): string
    {
        return Car::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom'),
            ImageField::new('image', 'Image')
                ->setUploadDir('public/uploads/cars')
                ->setBasePath('uploads/cars')
                ->setRequired(false),
            DateTimeField::new('updatedAt', 'Mise à jour'),
            AssociationField::new('brand', 'Marque'),
            AssociationField::new('servicePrices', 'Services')
                ->setFormTypeOptions(['by_reference' => false]),
            AssociationField::new('pieces', 'Pièces compatibles')
                ->setFormTypeOptions(['by_reference' => false]),
            AssociationField::new('userCars', 'Véhicules des utilisateurs')->onlyOnDetail(),
            AssociationField::new('models', 'Modèles')->onlyOnDetail(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $activate = Action::new('activate', 'Activer', 'fa fa-check')
            ->linkToCrudAction('activateCar')
            ->setCssClass('btn btn-success')
            ->displayIf(fn (Car $car) => !$car->IsActive());

        $deactivate = Action::new('deactivate', 'Désactiver', 'fa fa-times')
            ->linkToCrudAction('deactivateCar')
            ->setCssClass('btn btn-danger')
            ->displayIf(fn (Car $car) => $car->IsActive());

        return $actions
            ->add(Crud::PAGE_INDEX, $activate)
            ->add(Crud::PAGE_INDEX, $deactivate);
    }


    public function activateCar(AdminContext $context): RedirectResponse
    {
        $id = $context->getRequest()->query->get('entityId');
        $car = $this->em->getRepository(Car::class)->find($id);

        if ($car) {
            $car->setIsActive(true);
            $this->em->flush();
            $this->addFlash('success', sprintf('La voiture "%s" est activée !', $car->getName()));
        }

        return $this->redirectToIndex();
    }

    public function deactivateCar(AdminContext $context): RedirectResponse
    {
        $id = $context->getRequest()->query->get('entityId');
        $car = $this->em->getRepository(Car::class)->find($id);

        if ($car) {
            $car->setIsActive(false);
            $this->em->flush();
            $this->addFlash('success', sprintf('La voiture "%s" est désactivée !', $car->getName()));
        }

        return $this->redirectToIndex();
    }

    private function redirectToIndex(): RedirectResponse
    {
        $url = $this->adminUrlGenerator->setController(self::class)->setAction('index')->generateUrl();
        return $this->redirect($url);
    }
}
