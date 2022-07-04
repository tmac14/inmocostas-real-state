<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PhotoGalleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', AttachmentType::class)
        ;
    }

    public function  getBlockPrefix(): string
    {
        return 'photogallery_form';
    }
}