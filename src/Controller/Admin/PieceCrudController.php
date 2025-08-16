<?php

namespace App\Controller\Admin;

use App\Entity\Piece;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityManagerInterface;

class PieceCrudController extends AbstractCrudController
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
        return Piece::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom'),
            TextField::new('reference', 'Référence')->setRequired(false),
            TextEditorField::new('description', 'Description'),
            NumberField::new('minPrice', 'Prix minimum')->setNumDecimals(2),
            NumberField::new('quantity', 'Quantité'),
            TextField::new('category', 'Catégorie')->setRequired(false),

            CollectionField::new('compatibleCars', 'Voitures compatibles')
                ->setEntryType(AssociationField::class)
                ->allowAdd()
                ->allowDelete(),

            ImageField::new('image', 'Image')
                ->setUploadDir('public/uploads/pieces')
                ->setBasePath('uploads/pieces')
                ->setRequired(false),

            DateTimeField::new('updatedAt', 'Dernière modification')->hideOnForm(),

            CollectionField::new('servicePrices', 'Prix des services')
                ->setEntryType(AssociationField::class)
                ->allowAdd()
                ->allowDelete(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $activate = Action::new('activate', 'Activer', 'fa fa-check')
            ->linkToCrudAction('activatePiece')
            ->setCssClass('btn btn-success')
            ->displayIf(fn(Piece $piece) => !$piece->isActive());

        $deactivate = Action::new('deactivate', 'Désactiver', 'fa fa-times')
            ->linkToCrudAction('deactivatePiece')
            ->setCssClass('btn btn-danger')
            ->displayIf(fn(Piece $piece) => $piece->isActive());

        return $actions
            ->add(Crud::PAGE_INDEX, $activate)
            ->add(Crud::PAGE_INDEX, $deactivate);
    }

    public function activatePiece(AdminContext $context): RedirectResponse
    {
        $id = $context->getRequest()->query->get('entityId');
        $piece = $this->em->getRepository(Piece::class)->find($id);

        if ($piece) {
            $piece->setIsActive(true);
            $this->em->flush();
            $this->addFlash('success', sprintf('La pièce "%s" est activée !', $piece->getName()));
        }

        return $this->redirectToIndex();
    }

    public function deactivatePiece(AdminContext $context): RedirectResponse
    {
        $id = $context->getRequest()->query->get('entityId');
        $piece = $this->em->getRepository(Piece::class)->find($id);

        if ($piece) {
            $piece->setIsActive(false);
            $this->em->flush();
            $this->addFlash('success', sprintf('La pièce "%s" est désactivée !', $piece->getName()));
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
