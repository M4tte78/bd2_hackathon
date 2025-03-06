<?php

namespace App\Controller\Admin;

use App\Entity\Statut;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StatutCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Statut::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des statuts')
            ->setPageTitle(Crud::PAGE_NEW, 'Créer un nouveau statut')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un statut')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du statut')
            ->setEntityLabelInSingular('Statut')
            ->setEntityLabelInPlural('Statuts')
            ->setDefaultSort(['statut' => 'ASC']);
    }
    public function configureAssets(Assets $assets): Assets
    {
        return $assets->addCssFile('css/Form.css');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('statut', 'Nom du statut'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, fn (Action $action) =>
            $action->setLabel('Créer un statut'))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, fn (Action $action) =>
            $action->setLabel('Sauvegarder et retourner'))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, fn (Action $action) =>
            $action->setLabel('Sauvegarder et continuer'))
            ->update(Crud::PAGE_INDEX, Action::DELETE, fn (Action $action) =>
            $action->setLabel('Supprimer ce statut'))
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, fn (Action $action) =>
            $action->setLabel('Créer'));
    }
}
