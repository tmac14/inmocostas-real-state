<?php

namespace App\Controller\Admin\Crud;

use App\Entity\PropertyClass;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PropertyClassCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PropertyClass::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInSingular('Property Category')
            ->setEntityLabelInPlural('Property Categories');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()
            , AssociationField::new('parent')->setColumns(6)
            , TextField::new('name')->setColumns(6)
            ,
        ];
    }
}
