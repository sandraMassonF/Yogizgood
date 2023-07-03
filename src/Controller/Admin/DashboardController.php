<?php

namespace App\Controller\Admin;

use App\Entity\Kind;
use App\Entity\User;
use App\Entity\Booking;
use App\Entity\Product;
use App\Entity\Session;
use App\Entity\Purchase;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\SessionCrudController;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(SessionCrudController::class)->generateUrl());
       
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Yogizgood');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Mes cours', 'fas fa-om', Session::class);
        yield MenuItem::linkToCrud('Réservations', 'fas fa-calendar', Booking::class);
        yield MenuItem::linkToCrud('Type de cours', 'fas fa-pencil', Kind::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Cours achetés', 'fas fa-list', Product::class);
        yield MenuItem::linkToCrud('Paiements', 'fas fa-money-bill-wave', Purchase::class);
        yield MenuItem::linkToRoute('Accueil', 'fas fa-home','app_home');
    }
    

    
}
