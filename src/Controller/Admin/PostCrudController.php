<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\Image;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('Utilisateur')
            ->add('category')
            ->add('description');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setDisabled()->hideOnForm(),
            TextField::new('title')->setSortable(false),
            TextEditorField::new('description')->setSortable(false),
            TextEditorField::new('secondDescription')->setSortable(false),
            ImageField::new('picture')
                ->setUploadDir('public/upload/posts/images')
                ->setBasePath('upload/posts/images')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setFormTypeOptions([
                    'attr' => [
                        'accept' => 'image/*'
                    ]
                ])
                ->setSortable(false),
            ImageField::new('stlFile')
                ->setUploadDir('public/upload/posts/stlFile')
                ->setBasePath('upload/posts/stlFile')
                ->setUploadedFileNamePattern('[randomhash].stl')
                ->setFormTypeOptions([
                    'attr' => [
                        'accept' => '.stl'
                    ]
                ])
                ->setSortable(false),
            AssociationField::new('Utilisateur'),
            DateField::new('createdAt')->setDisabled()->hideOnForm(),
            DateField::new('updatedAt')->setDisabled()->hideOnForm(),
            TextField::new('code')->setSortable(false),
            AssociationField::new('category')->setSortable(false),
            BooleanField::new('isOnline')
        ];
    }

}
