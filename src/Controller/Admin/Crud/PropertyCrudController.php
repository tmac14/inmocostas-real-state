<?php

namespace App\Controller\Admin\Crud;

use App\EasyAdmin\PhotoGalleryField;
use App\Entity\Property;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PropertyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Property::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('admin/form/form_theme.html.twig')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return match($pageName) {
            Crud::PAGE_INDEX => $this->configureIndexFields(),
            Crud::PAGE_NEW => $this->configureNewFields(),
            Crud::PAGE_EDIT => $this->configureEditFields(),
            default => parent::configureFields($pageName),
        };
    }

    private function configureIndexFields(): array
    {
        return [
            TextField::new('internalRef', 'IN. REF')
            , TextField::new('externalRef', 'EX.REF')
            , TextField::new('title')
            , IntegerField::new('yearBuilt', 'Year')
            , NumberField::new('surfaceUtil', 'Surface Util (m2)')
            , NumberField::new('surfaceBuilt', 'Surface Built (m2)')
            , IntegerField::new('rooms')
            , IntegerField::new('bathrooms')
            , MoneyField::new('price')->setCurrency('EUR')
            , BooleanField::new('enabled')
        ];
    }

    private function configureNewFields(): array
    {
        return [
            FormField::addPanel('Metadata')
            , TextField::new('internalRef')->setColumns(6)
            , TextField::new('externalRef')->setColumns(6)
            , TextField::new('title')->setColumns(12)
            , TextEditorField::new('description')->setColumns(12)->setNumOfRows(14)
            , FormField::addPanel('Registry and Distribution')
            , AssociationField::new('propertyClass')->setColumns(4)
            , NumberField::new('surfaceUtil', 'Surface Util (m2)')->setColumns(4)
            , NumberField::new('surfaceBuilt', 'Surface Built (m2)')->setColumns(4)
            , IntegerField::new('rooms')->setColumns(4)
            , IntegerField::new('bathrooms')->setColumns(4)
            , FormField::addPanel('Commercialization')
            , MoneyField::new('price')
                ->setColumns(3)
                ->setCurrency('EUR')
            , ChoiceField::new('transactionType')
                ->setChoices(Property::PROPERTY_TRANSACTION_TYPES)
                ->setColumns(3)
            ,
        ];
    }

    private function configureEditFields(): array
    {
        return [
            FormField::addTab('General Information')
            , FormField::addPanel('Metadata')
            , TextField::new('internalRef')->setColumns(6)->setDisabled()
            , TextField::new('externalRef')->setColumns(6)
            , TextField::new('title')->setColumns(12)
            , TextEditorField::new('description')->setColumns(12)->setNumOfRows(14)
            , FormField::addPanel('Registry and Distribution')
            , IntegerField::new('yearBuilt')->setColumns(4)
            , ChoiceField::new('conservationStatus')
                ->setChoices(Property::PROPERTY_CONSERVATION_STATUSES)
                ->setColumns(4)
            , AssociationField::new('propertyClass')->setColumns(4)
            , NumberField::new('surfaceSimpleNote', 'Surface Simple Note (m2)')->setColumns(4)
            , NumberField::new('surfaceUtil', 'Surface Util (m2)')->setColumns(4)
            , NumberField::new('surfaceBuilt', 'Surface Built (m2)')->setColumns(4)
            , IntegerField::new('rooms')->setColumns(4)
            , IntegerField::new('bathrooms')->setColumns(4)
            , FormField::addPanel('Commercialization')
            , ChoiceField::new('internalAgencyStatus')
                ->setChoices(Property::PROPERTY_INTERNAL_AGENCY_STATUSES)
                ->setColumns(3)
            , ChoiceField::new('externalAgencyStatus')
                ->setChoices(Property::PROPERTY_EXTERNAL_AGENCY_STATUSES)
                ->setColumns(3)
            , ChoiceField::new('transactionType')
                ->setChoices(Property::PROPERTY_TRANSACTION_TYPES)
                ->setColumns(3)
            , MoneyField::new('price')
                ->setColumns(3)
                ->setCurrency('EUR')
            , FormField::addTab('Features')
            , FormField::addTab('Geodata')
            , FormField::addTab('Photos')
            , PhotoGalleryField::new('photos')
            , FormField::addTab('Documentation')
            , FormField::addTab('Security')
            ,
        ];
    }
}
