<?php

namespace App\Controller\Admin;

use App\Entity\Affectation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class AffectationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Affectation::class;
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets->addCssFile('css/Form.css');
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des affectations')
            ->setPageTitle(Crud::PAGE_NEW, 'Créer une nouvelle affectation')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier une affectation')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails de l\'affectation')
            ->setEntityLabelInSingular('Affectation')
            ->setEntityLabelInPlural('Affectations')
            ->setDefaultSort(['date_affectation_debut' => 'ASC']);
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
            ->update(Crud::PAGE_INDEX, Action::NEW, fn (Action $action) =>
            $action->setLabel('Créer une affectation'))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, fn (Action $action) =>
            $action->setLabel('Sauvegarder et retourner'))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, fn (Action $action) =>
            $action->setLabel('Sauvegarder et orcontinuer'))
            ->update(Crud::PAGE_INDEX, Action::DELETE, fn (Action $action) =>
            $action->setLabel('Supprimer cette affectation'))
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, fn (Action $action) =>
            $action->setLabel('Créer'));
    }
}
