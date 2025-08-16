<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
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

class BrandCrudController extends AbstractCrudController
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
        return Brand::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom de la marque'),
            ImageField::new('logo', 'Logo')
                ->setUploadDir('public/brands')
                ->setBasePath('brands')
                ->setRequired(false),
            TextField::new('country', 'Pays')->setRequired(false),
            AssociationField::new('cars', 'Voitures')->onlyOnDetail(),
            AssociationField::new('models', 'Modèles')->onlyOnDetail(),
        ];
    }

    public function configureActions(Actions $actions): Actions
{
    $activate = Action::new('activate', 'Activer', 'fa fa-check')
        ->linkToCrudAction('activateBrand')
        ->setCssClass('btn btn-success')
        ->displayIf(fn(Brand $brand) => !$brand->isActive());

    $deactivate = Action::new('deactivate', 'Désactiver', 'fa fa-times')
        ->linkToCrudAction('deactivateBrand')
        ->setCssClass('btn btn-danger')
        ->displayIf(fn(Brand $brand) => $brand->isActive());

    return $actions
        ->add(Crud::PAGE_INDEX, $activate)
        ->add(Crud::PAGE_INDEX, $deactivate);
}

public function deactivateBrand(AdminContext $context): RedirectResponse
{
    $brandId = $context->getRequest()->query->get('entityId');
    $brand = $this->em->getRepository(Brand::class)->find($brandId);

    if ($brand) {
        $brand->setIsActive(false);
        $this->em->flush();

        $this->addFlash('success', sprintf('La marque "%s" est désactivée !', $brand->getName()));
    }

    $url = $this->adminUrlGenerator
        ->setController(self::class)
        ->setAction('index')
        ->generateUrl();

    return $this->redirect($url);
}



    public function activateBrand(AdminContext $context): RedirectResponse
    {
        $brandId = $context->getRequest()->query->get('entityId'); // récupère l'ID de l'URL
        $brand = $this->em->getRepository(Brand::class)->find($brandId);

        if ($brand) {
            $brand->setIsActive(true);
            $this->em->flush();

            $this->addFlash('success', sprintf('La marque "%s" est activée !', $brand->getName()));
        }

        $url = $this->adminUrlGenerator
            ->setController(self::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);
    }


}
