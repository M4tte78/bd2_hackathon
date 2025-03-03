<?php

namespace App\Controller\Admin;

use App\Entity\Statut;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StatutCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Statut::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('statut', 'Nom du statut'),
        ];
    }
}