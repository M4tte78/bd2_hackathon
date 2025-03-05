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
        ->setTitle('TEAMBUILD')
        ->renderContentMaximized() // Pleine largeur
        ->disableDarkMode(); // Désactive le mode sombre
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::section('Navigation'),
            MenuItem::linkToDashboard('Accueil', 'fas fa-home'),
            MenuItem::linkToCrud('Rôles', 'fas fa-user-tag', Role::class),
            MenuItem::linkToCrud('Métiers', 'fas fa-tools', Competences::class),
            MenuItem::linkToCrud('Employés', 'fas fa-users', Employe::class),
            MenuItem::linkToCrud('Chantiers', 'fas fa-building', Chantier::class),
            MenuItem::linkToCrud('Affectations', 'fas fa-calendar-check', Affectation::class),
            MenuItem::section('Gestion Utilisateurs'),
            MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Utilisateur::class),
            MenuItem::linkToLogout('Déconnexion', 'fas fa-sign-out-alt'),
        ];
    }
}
