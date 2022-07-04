<?php

namespace App\EasyAdmin;

use App\Form\PhotoGalleryType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class PhotoGalleryField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null)
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            // this template is used in the index and details page
            ->setTemplatePath('admin/field/photoGallery.html.twig')
            // this is used in the edit and new pages
            ->setFormType(PhotoGalleryType::class)
            ;
    }
/*
    public function getAsDto(): FieldDto
    {
        // TODO: Implement getAsDto() method.
    }
*/
}