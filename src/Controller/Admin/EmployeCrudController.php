<?php 

namespace App\Controller\Admin;

use App\Entity\Employe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ActionsField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;

class EmployeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Employe::class;
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets
            ->addCssFile('css/employe.css');
    }  
        
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Masquer l'ID dans le formulaire
            AssociationField::new('competences', 'Métier')
                ->setRequired(true), 
            TextField::new('nom', 'Nom')
                ->setRequired(true), 
            TextField::new('prenom', 'Prénom')
                ->setRequired(true), 
            EmailField::new('email', 'Email')
                ->setRequired(true),
            TelephoneField::new('telephone', 'Téléphone')
                ->setRequired(true), 
            TextField::new('adresse', 'Adresse')
                ->setRequired(false), 

            // Bouton Modifier
            UrlField::new('modifier', 'Action')
                ->formatValue(fn ($value, $entity) => sprintf(
                    '<a href="%s" class="btn btn-edit">Modifier</a>',
                    $this->generateUrl('admin', [
                        'crudAction' => 'edit', 
                        'crudControllerFqcn' => self::class, 
                        'entityId' => $entity->getId()
                    ])
                ))
                ->onlyOnIndex()
                ->setVirtual(true),
        ];
    }

    public function configureActions(Actions $actions): Actions
{
    return $actions
        ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
            return $action->setLabel('Supprimer')->setCssClass('btn btn-danger');
        })
        ->add(Crud::PAGE_INDEX, Action::DETAIL);
}

}
