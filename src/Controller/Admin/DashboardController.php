<?php 

namespace App\Controller\Admin;

use App\Entity\Employe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

use App\Entity\Statut;
use App\Entity\Role;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureMenuItems(): iterable
    {
        return [
            yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            yield MenuItem::linkToCrud('Statut', 'fas fa-list', Statut::class),
            yield MenuItem::linkToCrud('Role', 'fas fa-users', Role::class),
            yield MenuItem::linkToCrud('Employe', 'fas fa-users', Employe::class),
        ];
    }
}
