<?php

namespace App\Controller\Admin;

use App\Entity\Role;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RoleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Role::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des rôles')
            ->setPageTitle(Crud::PAGE_NEW, 'Créer un nouveau rôle')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un rôle')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du rôle')
            ->setEntityLabelInSingular('Rôle')
            ->setEntityLabelInPlural('Rôles')
            ->setDefaultSort(['role' => 'ASC']);
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets->addCssFile('css/Form.css');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('role', 'Nom du rôle'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, fn (Action $action) =>
            $action->setLabel('Créer un rôle'))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, fn (Action $action) =>
            $action->setLabel('Sauvegarder et retourner'))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, fn (Action $action) =>
            $action->setLabel('Sauvegarder et continuer'))
            ->update(Crud::PAGE_INDEX, Action::DELETE, fn (Action $action) =>
            $action->setLabel('Supprimer ce rôle'))
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, fn (Action $action) =>
            $action->setLabel('Créer'));
    }
}
