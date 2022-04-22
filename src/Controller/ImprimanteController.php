<?php

namespace App\Controller;

use App\Entity\FormImprimante;
use App\Form\ImprimanteFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImprimanteController extends AbstractController
{
    #[Route('/imprimante', name: 'app_imprimante')]
    public function index(Request $request): Response
    {
        $formImprimante = new FormImprimante();
        $form = $this->createForm(ImprimanteFormType::class, $formImprimante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->getUser()) {
                return $this->redirectToRoute('app_login');
            }
            dd($form);
        }

        return $this->render('imprimante/index.html.twig', [
            'controller_name' => 'ImprimanteController',
            'imprimateForm' => $form->createView()
        ]);
    }
}
