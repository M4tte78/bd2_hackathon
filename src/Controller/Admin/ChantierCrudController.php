<?php

namespace App\Controller\Admin;

use App\Entity\Chantier;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
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

    public function configureAssets(Assets $assets): Assets
    {
        return $assets->addCssFile('css/Form.css');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des chantiers')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un chantier')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un chantier')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du chantier')
            ->setEntityLabelInSingular('Chantier')
            ->setEntityLabelInPlural('Chantiers')
            ->setDefaultSort(['date_debut' => 'ASC']); // Trie par date de début
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, fn (Action $action) =>
            $action->setLabel('Ajouter un chantier'))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, fn (Action $action) =>
            $action->setLabel('Sauvegarder et retourner'))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, fn (Action $action) =>
            $action->setLabel('Sauvegarder et continuer'))
            ->update(Crud::PAGE_INDEX, Action::DELETE, fn (Action $action) =>
            $action->setLabel('Supprimer ce chantier'))
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, fn (Action $action) =>
            $action->setLabel('Créer'));
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
