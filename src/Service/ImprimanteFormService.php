<?php

namespace App\Service;

use App\Entity\Comments;
use App\Entity\FormImprimante;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Twig\Environment;

class ImprimanteFormService
{
    public function __construct(
        private EntityManagerInterface $em,
        private Environment $environment
    )
    {

    }

    public function handleImprimanteForm(FormInterface $form, $randomInt) : void
    {
        if ($form->isValid() && $form['impressionName']->getData() && $form['description']->getData() && $form['stlFile']->getData())
        {
            $this->handleValidForm($form, $randomInt);
        } else {
            $this->handleInvalidForm($form);
        }
    }

    public function handleValidForm(FormInterface $form, $randomInt) : void
    {
        /** @var FormImprimante $formImprimante */
        $formImprimante = $form->getData();
        if ($file = $form['stlFile']->getData()) {
            $newsUserPicture = '';
            $newName = $randomInt . '.' . "stl";
            $file->move('upload/stlFile/', $newName);
            $formImprimante->setStlFile($newName);
        }

        $this->em->persist($formImprimante);
        $this->em->flush();
    }

    public function handleInvalidForm(FormInterface $form) : JsonResponse
    {
        return new JsonResponse([
            'errors' => $this->getErrorsMessages($form)
        ]);

    }

    private function getErrorsMessages(FormInterface $form): array
    {
        $errors = [];

        foreach ($form->getErrors() as $error)
        {
            $errors[] = $error->getMessage();
        }


        foreach ($form->all() as $child)
        {
            if (!$child->isValid())
            {
                $errors[$child->getName()] = $this->getErrorsMessages($child);
            }
        }
        return $errors;
    }
}