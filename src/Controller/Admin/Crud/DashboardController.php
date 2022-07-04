<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Configuration;
use App\Entity\Property;
use App\Entity\Feature;
use App\Entity\PropertyClass;
use App\Entity\PropertyFeature;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Inmocostas Real State');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');

        yield MenuItem::section('Properties');
        yield MenuItem::linkToCrud('Portfolio', 'fa fa-home', Property::class);
        yield MenuItem::linkToCrud('Categories', 'fa fa-industry', PropertyClass::class);
        yield MenuItem::linkToCrud('Features', 'fa fa-industry', Feature::class);

        yield MenuItem::section('System');
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
        // yield MenuItem::linkToCrud('Configuration', 'fa fa-wrench', Configuration::class);
    }

    public function configureAssets(): Assets
    {
        return parent::configureAssets()
            ->addWebpackEncoreEntry('app');
    }
}
