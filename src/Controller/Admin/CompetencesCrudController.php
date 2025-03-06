<?php

namespace App\Controller\Admin;

use App\Entity\Competences;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompetencesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Competences::class;
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets->addCssFile('css/Form.css');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des compétences')
            ->setPageTitle(Crud::PAGE_NEW, 'Créer une nouvelle compétence')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier une compétence')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails de la compétence')
            ->setEntityLabelInSingular('Compétence')
            ->setEntityLabelInPlural('Compétences')
            ->setDefaultSort(['nom' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom', 'Nom de la compétence'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, fn (Action $action) =>
            $action->setLabel('Créer une compétence'))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, fn (Action $action) =>
            $action->setLabel('Sauvegarder et retourner'))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, fn (Action $action) =>
            $action->setLabel('Sauvegarder et continuer'))
            ->update(Crud::PAGE_INDEX, Action::DELETE, fn (Action $action) =>
            $action->setLabel('Supprimer cette compétence'))
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, fn (Action $action) =>
            $action->setLabel('Créer'));
    }
}
