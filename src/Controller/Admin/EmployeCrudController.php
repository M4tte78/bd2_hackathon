<?php

namespace App\Controller\Admin;

use App\Entity\Employe;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class EmployeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Employe::class;
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets->addCssFile('css/Form.css');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des employés')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un nouvel employé')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un employé')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails de l\'employé')
            ->setEntityLabelInSingular('Employé')
            ->setEntityLabelInPlural('Employés')
            ->setDefaultSort(['nom' => 'ASC']);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, fn (Action $action) =>
            $action->setLabel('Ajouter un employé'))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, fn (Action $action) =>
            $action->setLabel('Sauvegarder et retourner'))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, fn (Action $action) =>
            $action->setLabel('Sauvegarder et continuer'))
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, fn (Action $action) =>
            $action->setLabel('Créer'))
            ->update(Crud::PAGE_INDEX, Action::DELETE, fn (Action $action) =>
            $action->setLabel('Supprimer cet employé'));
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom', 'Nom'),
            TextField::new('prenom', 'Prénom'),
            EmailField::new('email', 'Email'),
            TextField::new('telephone', 'Téléphone'),
            TextField::new('adresse', 'Adresse'),
            AssociationField::new('competences', 'Métier'),
        ];
    }
}
