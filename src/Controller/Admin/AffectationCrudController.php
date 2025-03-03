<?php

namespace App\Controller\Admin;

use App\Entity\Affectation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

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
            DateField::new('date_debut', 'Date de début'),
            DateField::new('date_fin', 'Date de fin'),
        ];
    }
}