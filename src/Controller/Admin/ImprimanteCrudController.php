<?php

namespace App\Controller\Admin;

use App\Entity\Imprimante;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\Date;

class ImprimanteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Imprimante::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('formImprimante')
            ->add('time')
            ->add('working');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->setDisabled(),
            AssociationField::new('formImprimante')->hideOnForm(),
            DateTimeField::new('time'),
            BooleanField::new('working')->setSortable(true)->hideOnForm(),
            DateField::new('createdAt'),
            DateField::new('updatedAt'),
            TextField::new('name')
        ];
    }

}
