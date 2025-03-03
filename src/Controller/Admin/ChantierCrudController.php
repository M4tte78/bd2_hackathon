<?php 

namespace App\Controller\Admin;

use App\Entity\Chantier;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ChantierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chantier::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom', 'Nom du chantier'),
            TextField::new('adresse', 'Adresse du chantier'),
            DateField::new('date_debut', 'Date de début'),
            DateField::new('date_fin', 'Date de fin'),
            AssociationField::new('statut', 'Statut du chantier'),
        ];
    }
}