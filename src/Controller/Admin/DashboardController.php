<?php 

namespace App\Controller\Admin;

use App\Entity\Affectation;
use App\Entity\Chantier;
use App\Entity\Competences;
use App\Entity\Employe;
use App\Entity\Statut;
use App\Entity\Role;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use Symfony\Component\Routing\RouterInterface;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $calendarUrl = $this->generateUrl('affectation_calendar');

        return $this->render('admin/dashboard.html.twig', [
            'calendar_url' => $calendarUrl,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
        ->setTitle('TEAMBUILD');
    }

    public function configureMenuItems(): iterable
    {
        return [
            yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            yield MenuItem::linkToCrud('Rôles', 'fas fa-circle-check', Role::class),
            yield MenuItem::linkToCrud('Statuts', 'fas fa-spinner', Statut::class),
            yield MenuItem::linkToCrud('Métiers', 'fas fa-hammer', Competences::class),
            yield MenuItem::linkToCrud('Ouvriers', 'fas fa-users', Employe::class),
            yield MenuItem::linkToCrud('Chantiers', 'fas fa-helmet-safety', Chantier::class),
            yield MenuItem::linkToCrud('Affectations', 'fas fa-person-digging', Affectation::class),
            yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Utilisateur::class)
        ];
    }
}
