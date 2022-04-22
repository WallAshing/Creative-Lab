<?php

namespace App\Service;

use App\Entity\Comments;
use App\Entity\FormImprimante;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Twig\Environment;

class ContactFormService
{
    public function __construct(
        private EntityManagerInterface $em,
        private Environment $environment
    )
    {

    }

    public function handleContactForm(FormInterface $form,) : void
    {
        if ($form->isValid())
        {
            $this->handleValidForm($form);
        }
    }

    public function handleValidForm(FormInterface $form) : void
    {
        /** @var FormImprimante $formImprimante */
        $formContact = $form->getData();

        $this->em->persist($formImprimante);
        $this->em->flush();
    }

}