<?php

namespace App\Controller\Admin;

use App\Entity\Affectation;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AffectationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Affectation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('employe', 'Employé'),
            AssociationField::new('chantier', 'Chantier'),
            DateField::new('date_affectation_debut', 'Date de début'),
            DateField::new('date_affectation_fin', 'Date de fin'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(
                'index',
                Action::new('calendar', 'Calendrier')
                    ->linkToRoute('affectation_calendar')
                    ->setCssClass('btn btn-primary')
            );
    }
}