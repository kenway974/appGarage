<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityManagerInterface;

class ServiceCrudController extends AbstractCrudController
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
        return Service::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre'),
            TextareaField::new('description', 'Description'),
            NumberField::new('minPrice', 'Prix minimum')->setNumDecimals(2),
            TextField::new('category', 'Catégorie')->setRequired(false),
            BooleanField::new('isActive', 'Actif'),

            CollectionField::new('servicePrices', 'Prix liés')
                ->setEntryType(AssociationField::class)
                ->allowAdd()
                ->allowDelete(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $activate = Action::new('activate', 'Activer', 'fa fa-check')
            ->linkToCrudAction('activateService')
            ->setCssClass('btn btn-success')
            ->displayIf(fn(Service $service) => !$service->isActive());

        $deactivate = Action::new('deactivate', 'Désactiver', 'fa fa-times')
            ->linkToCrudAction('deactivateService')
            ->setCssClass('btn btn-danger')
            ->displayIf(fn(Service $service) => $service->isActive());

        return $actions
            ->add(Crud::PAGE_INDEX, $activate)
            ->add(Crud::PAGE_INDEX, $deactivate);
    }

    public function activateService(AdminContext $context): RedirectResponse
    {
        $id = $context->getRequest()->query->get('entityId');
        $service = $this->em->getRepository(Service::class)->find($id);

        if ($service) {
            $service->setIsActive(true);
            $this->em->flush();
            $this->addFlash('success', sprintf('Le service "%s" est activé !', $service->getTitle()));
        }

        return $this->redirectToIndex();
    }

    public function deactivateService(AdminContext $context): RedirectResponse
    {
        $id = $context->getRequest()->query->get('entityId');
        $service = $this->em->getRepository(Service::class)->find($id);

        if ($service) {
            $service->setIsActive(false);
            $this->em->flush();
            $this->addFlash('success', sprintf('Le service "%s" est désactivé !', $service->getTitle()));
        }

        return $this->redirectToIndex();
    }

    private function redirectToIndex(): RedirectResponse
    {
        $url = $this->adminUrlGenerator
            ->setController(self::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);
    }
}
