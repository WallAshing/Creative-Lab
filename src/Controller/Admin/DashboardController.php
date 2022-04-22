<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\Event;
use App\Entity\FormImprimante;
use App\Entity\Imprimante;
use App\Entity\Materiaux;
use App\Entity\Post;
use App\Entity\PostCateogies;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Dashboard Creative Lab')
            ->setFaviconPath('upload/logo/Groupe.png');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Return');
        yield MenuItem::linkToRoute('Home', 'fas fa-home', 'app_home');

        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::section('Post');
        yield MenuItem::subMenu('Action', 'fas fa-folder')->setSubItems([
            MenuItem::linkToCrud("Voir les posts", 'fas fa-eye', Post::class)->setAction(Crud::PAGE_INDEX)
        ]);
        yield MenuItem::section('Contact');
        yield MenuItem::subMenu('Action', 'fas fa-folder')->setSubItems([
            MenuItem::linkToCrud("Voir les demandes de contact", 'fas fa-eye', Contact::class)->setAction(Crud::PAGE_INDEX)
        ]);
        yield MenuItem::section('Event');
        yield MenuItem::subMenu('Action', 'fas fa-folder')->setSubItems([
            MenuItem::linkToCrud("Voir les events", 'fas fa-eye', Event::class)->setAction(Crud::PAGE_INDEX)
        ]);
        yield MenuItem::section("Demande d'imprimante");
        yield MenuItem::subMenu('Action', 'fas fa-folder')->setSubItems([
            MenuItem::linkToCrud("Voir les demandes d'imprimante", 'fas fa-eye', FormImprimante::class)->setAction(Crud::PAGE_INDEX)
        ]);
        yield MenuItem::section('Imprimante');
        yield MenuItem::subMenu('Action', 'fas fa-folder')->setSubItems([
            MenuItem::linkToCrud("Voir les imprimantes", 'fas fa-eye', Imprimante::class)->setAction(Crud::PAGE_INDEX)
        ]);
        yield MenuItem::section('Materiaux');
        yield MenuItem::subMenu('Action', 'fas fa-folder')->setSubItems([
            MenuItem::linkToCrud("Voir les materiaux", 'fas fa-eye', Materiaux::class)->setAction(Crud::PAGE_INDEX)
        ]);
        yield MenuItem::section('Categories de post');
        yield MenuItem::subMenu('Action', 'fas fa-folder')->setSubItems([
            MenuItem::linkToCrud("Voir les categories de post", 'fas fa-eye', PostCateogies::class)->setAction(Crud::PAGE_INDEX)
        ]);
    }
}