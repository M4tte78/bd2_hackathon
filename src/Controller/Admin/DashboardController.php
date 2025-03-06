<?php

namespace App\Controller\Admin;

use App\Entity\Affectation;
use App\Entity\Chantier;
use App\Entity\Competences;
use App\Entity\Employe;
use App\Entity\Statut;
use App\Entity\Role;
use App\Entity\Utilisateur;
use App\Repository\ChantierRepository;
use App\Repository\AffectationRepository;
use App\Repository\EmployeRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use Doctrine\ORM\EntityManagerInterface;

class DashboardController extends AbstractDashboardController
{
    private $chantierRepository;
    private $affectationRepository;
    private $employeRepository;

    public function __construct(
        ChantierRepository $chantierRepository,
        AffectationRepository $affectationRepository,
        EmployeRepository $employeRepository
    ) {
        $this->chantierRepository = $chantierRepository;
        $this->affectationRepository = $affectationRepository;
        $this->employeRepository = $employeRepository;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $calendarUrl = $this->generateUrl('affectation_calendar');

        $chantiersEnCours = $this->chantierRepository->count(['statut' => 1]);
        $chantiersEnAttente = $this->chantierRepository->count(['statut' => 2]);
        $employesActifs = $this->employeRepository->count([]);

        return $this->render('admin/dashboard.html.twig', [
            'calendar_url' => $calendarUrl,
            'chantiers_en_cours' => $chantiersEnCours,
            'chantiers_en_attente' => $chantiersEnAttente,
            'employes_actifs' => $employesActifs,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('TEAMBUILD')
            ->renderContentMaximized()
            ->disableDarkMode();
    }

    public function configureAssets(): Assets
    {
        return parent::configureAssets()
            ->addCssFile('css/navbarDashboard.css');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Accueil', 'fas fa-home'),
            MenuItem::section('Navigation'),
            MenuItem::linkToCrud('Employés', 'fas fa-users', Employe::class),
            MenuItem::linkToCrud('Chantiers', 'fas fa-building', Chantier::class),
            MenuItem::linkToCrud('Affectations', 'fas fa-calendar-check', Affectation::class),
            MenuItem::section('Gestion Utilisateurs'),
            MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Utilisateur::class),
            MenuItem::section('Paramètres'),
            MenuItem::linkToCrud('Rôles', 'fas fa-user-tag', Role::class),
            MenuItem::linkToCrud('Métiers', 'fas fa-tools', Competences::class),
            MenuItem::linkToCrud('Status', 'fas fa-clock', Statut::class),
            MenuItem::linkToLogout('Déconnexion', 'fas fa-sign-out-alt'),
        ];
    }
}
