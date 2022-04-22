<?php

namespace App\Controller;

use App\Entity\FormImprimante;
use App\Form\ImprimanteFormType;
use App\Repository\FormImprimanteRepository;
use App\Repository\ImprimanteRepository;
use App\Service\ImprimanteFormService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImprimanteController extends AbstractController
{
    #[Route('/imprimante', name: 'app_imprimante')]
    public function index(Request $request, ImprimanteFormService $imprimanteFormService, FormImprimanteRepository $imprimanteRepository, ImprimanteRepository $imprimanteRepo): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $formImprimante = new FormImprimante();
        $imprantes = $imprimanteRepo->findAll();
        $imprimanteKey = rand(0, (count($imprantes) - 1));
        $form = $this->createForm(ImprimanteFormType::class, $imprimanteRepository->new($this->getUser(), $imprantes[$imprimanteKey]));
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $imprimanteFormService->handleImprimanteForm($form, random_int(2, 999999));
            return $this->redirectToRoute('app_home');
        }


        return $this->render('imprimante/index.html.twig', [
            'controller_name' => 'ImprimanteController',
            'imprimateForm' => $form->createView()
        ]);
    }
}
