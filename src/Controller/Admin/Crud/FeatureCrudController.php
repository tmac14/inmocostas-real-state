<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Feature;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FeatureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Feature::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Property Feature')
            ->setEntityLabelInPlural('Property Features');
    }

    public function configureFields(string $pageName): iterable
    {
        $valueTypes = ['String', 'Integer', 'Boolean', 'Choice', 'Custom'];

        yield IdField::new('id')->hideOnForm();
        yield TextField::new('icon')->onlyOnForms();
        yield TextField::new('name');
        yield ChoiceField::new('valueType', 'Type')
            ->setChoices(array_combine($valueTypes, $valueTypes));
        yield TextField::new('valueFormat', 'Format');
        yield BooleanField::new('enabled')->renderAsSwitch(false);
    }
}
