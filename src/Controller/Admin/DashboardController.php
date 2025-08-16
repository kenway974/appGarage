<?php

namespace App\Controller\Admin;

use App\Entity\Appointment;
use App\Entity\Brand;
use App\Entity\Car;
use App\Entity\Contact;
use App\Entity\Model;
use App\Entity\Piece;
use App\Entity\Quote;
use App\Entity\Service;
use App\Entity\ServicePrice;
use App\Entity\UserCar;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'welcome_message' => 'Bienvenue sur App Garage !',
        ]);
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App Garage');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Gestion des rendez-vous');
        yield MenuItem::linkToCrud('Appointments', 'fa fa-calendar', Appointment::class);

        yield MenuItem::section('Véhicules');
        yield MenuItem::linkToCrud('Brands', 'fa fa-tag', Brand::class);
        yield MenuItem::linkToCrud('Models', 'fa fa-car', Model::class);
        yield MenuItem::linkToCrud('Cars', 'fa fa-car-side', Car::class);
        yield MenuItem::linkToCrud('UserCars', 'fa fa-user-car', UserCar::class);

        yield MenuItem::section('Contacts & devis');
        yield MenuItem::linkToCrud('Contacts', 'fa fa-address-book', Contact::class);
        yield MenuItem::linkToCrud('Quotes', 'fa fa-file-invoice', Quote::class);

        yield MenuItem::section('Services & pièces');
        yield MenuItem::linkToCrud('Services', 'fa fa-wrench', Service::class);
        yield MenuItem::linkToCrud('Service Prices', 'fa fa-dollar-sign', ServicePrice::class);
        yield MenuItem::linkToCrud('Pieces', 'fa fa-cogs', Piece::class);

        yield MenuItem::section('Utilisateurs');
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
    }
}
