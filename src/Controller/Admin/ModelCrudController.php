<?php

namespace App\Controller\Admin;

use App\Entity\Model;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityManagerInterface;

class ModelCrudController extends AbstractCrudController
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
        return Model::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom du modèle'),
            AssociationField::new('brand', 'Marque'),
            AssociationField::new('car', 'Voiture'),
            IntegerField::new('releaseYear', 'Année de sortie'),
            IntegerField::new('discontinuedYear', 'Année d’arrêt'),
            TextField::new('category', 'Catégorie'),
            TextField::new('fuel', 'Carburant'),
            IntegerField::new('horsepower', 'Chevaux')->setRequired(false),
            TextField::new('transmission', 'Transmission')->setRequired(false),
            TextField::new('driveType', 'Transmission finale'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $activate = Action::new('activate', 'Activer', 'fa fa-check')
            ->linkToCrudAction('activateModel')
            ->setCssClass('btn btn-success')
            ->displayIf(fn(Model $model) => !$model->isActive());

        $deactivate = Action::new('deactivate', 'Désactiver', 'fa fa-times')
            ->linkToCrudAction('deactivateModel')
            ->setCssClass('btn btn-danger')
            ->displayIf(fn(Model $model) => $model->isActive());

        return $actions
            ->add(Crud::PAGE_INDEX, $activate)
            ->add(Crud::PAGE_INDEX, $deactivate);
    }

    public function activateModel(AdminContext $context): RedirectResponse
    {
        $id = $context->getRequest()->query->get('entityId');
        $model = $this->em->getRepository(Model::class)->find($id);

        if ($model) {
            $model->setIsActive(true);
            $this->em->flush();
            $this->addFlash('success', sprintf('Le modèle "%s" est activé !', $model->getName()));
        }

        return $this->redirectToIndex();
    }

    public function deactivateModel(AdminContext $context): RedirectResponse
    {
        $id = $context->getRequest()->query->get('entityId');
        $model = $this->em->getRepository(Model::class)->find($id);

        if ($model) {
            $model->setIsActive(false);
            $this->em->flush();
            $this->addFlash('success', sprintf('Le modèle "%s" est désactivé !', $model->getName()));
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
