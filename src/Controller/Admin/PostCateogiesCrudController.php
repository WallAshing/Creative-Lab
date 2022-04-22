<?php

namespace App\Controller\Admin;

use App\Entity\PostCateogies;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCateogiesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PostCateogies::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('posts');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->setDisabled(),
            TextField::new('name')->setSortable(false),
            AssociationField::new('posts')->hideOnForm(),
        ];
    }

}
