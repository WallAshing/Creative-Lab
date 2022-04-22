<?php

namespace App\Controller\Admin;

use App\Entity\Materiaux;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MateriauxCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Materiaux::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('quantity')
            ->add('createdAt')
            ->add('updatedAt');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->setDisabled(),
            TextField::new('name')->setSortable(false),
            TextEditorField::new('description'),
            IntegerField::new('quantity'),
            DateField::new('createdAt')->hideOnForm(),
            DateField::new('updatedAt')->hideOnForm()
        ];
    }

}
