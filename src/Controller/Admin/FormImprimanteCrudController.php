<?php

namespace App\Controller\Admin;

use App\Entity\FormImprimante;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FormImprimanteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FormImprimante::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('Utilisateur')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('imprimante');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->setDisabled(),
            AssociationField::new('Utilisateur'),
            TextField::new('impressionName'),
            TextEditorField::new('description'),
            ImageField::new('stlFile')
                ->setUploadDir('public/upload/stlFile')
                ->setBasePath('upload/stlFile')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setFormTypeOptions([
                    'attr' => [
                        'accept' => '.stl'
                    ]
                ])
                ->setSortable(false),
            DateField::new('createdAt')->setSortable(false)->hideOnForm(),
            DateField::new('updatedAt')->setSortable(false)->hideOnForm(),
            AssociationField::new('imprimante')
        ];
    }

}
