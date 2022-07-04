<?php

namespace App\Controller\Admin\Crud;

use App\Entity\PropertyFeature;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PropertyFeatureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PropertyFeature::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('feature')->autocomplete(),
            TextField::new('value'),
        ];
    }
}
