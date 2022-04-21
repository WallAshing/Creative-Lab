<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImprimanteController extends AbstractController
{
    #[Route('/imprimante', name: 'app_imprimante')]
    public function index(): Response
    {
        return $this->render('imprimante/index.html.twig', [
            'controller_name' => 'ImprimanteController',
        ]);
    }
}
