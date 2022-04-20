<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setDisabled()->hideOnForm(),
            EmailField::new('email'),
            ChoiceField::new('roles')->allowMultipleChoices()->setChoices([
                    'Administrator' => 'ROLE_ADMIN',
                    'User' => 'ROLE_USER',
                    'Editeur' => 'ROLE_EDITEUR'
                ]
            ),
            TextField::new('password')->setDisabled()->hideOnIndex(),
            TextField::new('name'),
            TextField::new('prenom'),
            ImageField::new('picture')
                ->setSortable(false)
                ->setUploadDir('public/upload/user')
                ->setBasePath('upload/user')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setFormTypeOptions([
                    'attr' => [
                        'accept' => 'image/*'
                    ]
                ]),
            DateField::new('createdAt')->setDisabled(),
            DateField::new('updatedAt')->setDisabled()
        ];
    }

}
