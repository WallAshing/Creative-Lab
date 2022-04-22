<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class ImprimanteFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('impressionName', null, [
                'attr' => ['class' => 'text']
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'text']
            ])
            ->add('stlFile', FileType::class, [
                'attr' => ['class' => 'text']
            ]);
    }

}