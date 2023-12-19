<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Distributeur;
use App\Entity\Photo;
use App\Entity\Product;
use App\Entity\Reference;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(ProductCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ecommerce admin')
//            ->renderSidebarMinimized()
            ->generateRelativeUrls();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Back to homepage', 'fa fa-arrow-left', 'app_home');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Category', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Distributeur', 'fas fa-truck', Distributeur::class);
        yield MenuItem::linkToCrud('Photo', 'fas fa-images', Photo::class);
        yield MenuItem::linkToCrud('Product', 'fas fa-tag', Product::class);
        yield MenuItem::linkToCrud('Reference', 'fas fa-expand-alt', Reference::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user', Utilisateur::class);
    }
}
