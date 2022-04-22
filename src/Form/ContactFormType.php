<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('phoneNumber', null, [
                'attr' => ['class' => 'text']
            ])
            ->add('personalEmail', EmailType::class, [
                'attr' => ['class' => 'text']
            ])
            ->add('discordTag', null, [
                'attr' => ['class' => 'text']
            ])
            ->add('Jeproposemonidee', SubmitType::class, [
            ]);;
    }

}