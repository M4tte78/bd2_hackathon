<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UtilisateurCrudController extends AbstractCrudController
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public static function getEntityFqcn(): string
    {
        return Utilisateur::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des utilisateurs')
            ->setPageTitle(Crud::PAGE_NEW, 'Créer un nouvel utilisateur')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un utilisateur')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails de l\'utilisateur')
            ->setEntityLabelInSingular('Utilisateur')
            ->setEntityLabelInPlural('Utilisateurs')
            ->setDefaultSort(['email' => 'ASC']);
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets->addCssFile('css/Form.css');
    }

    public function configureFields(string $pageName): iterable
    {
        $passwordField = TextField::new('password', 'Mot de passe')
            ->onlyOnForms()
            ->setRequired($pageName === Crud::PAGE_NEW)
            ->setFormTypeOptions([
                'attr' => ['autocomplete' => 'new-password']
            ]);

        return [
            TextField::new('email', 'Email'),
            $passwordField,
            AssociationField::new('role', 'Rôle'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, fn (Action $action) =>
            $action->setLabel('Créer un utilisateur'))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, fn (Action $action) =>
            $action->setLabel('Sauvegarder et retourner'))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, fn (Action $action) =>
            $action->setLabel('Sauvegarder et continuer'))
            ->update(Crud::PAGE_INDEX, Action::DELETE, fn (Action $action) =>
            $action->setLabel('Supprimer cet utilisateur'))
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, fn (Action $action) =>
            $action->setLabel('Créer'));
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Utilisateur) {
            return;
        }

        if ($entityInstance->getPassword()) {
            $hashedPassword = $this->passwordHasher->hashPassword($entityInstance, $entityInstance->getPassword());
            $entityInstance->setPassword($hashedPassword);
        }

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Utilisateur) {
            return;
        }

        $existingUser = $entityManager->getRepository(Utilisateur::class)->find($entityInstance->getId());

        if ($entityInstance->getPassword() && $existingUser->getPassword() !== $entityInstance->getPassword()) {
            $hashedPassword = $this->passwordHasher->hashPassword($entityInstance, $entityInstance->getPassword());
            $entityInstance->setPassword($hashedPassword);
        }

        parent::updateEntity($entityManager, $entityInstance);
    }
}
