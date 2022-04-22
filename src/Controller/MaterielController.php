<?php

namespace App\Controller;

use App\Repository\MateriauxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterielController extends AbstractController
{
    #[Route('/materiel', name: 'app_materiel')]
    public function index(MateriauxRepository $materiauxRepository): Response
    {
        $materiaux1 = [];
        $materiaux2 = [];
        $allMateriaux = $materiauxRepository->findAll();
        $singleMateriaux = $materiauxRepository->getMax();
        for ($i = 0; $i < count($allMateriaux); $i++) {
            if (count($materiaux1) != 4) {
                $materiaux1[] = $allMateriaux[$i];
            } else {
                $materiaux2[] = $allMateriaux[$i];
            }

    }


        return $this->render('materiel/index.html.twig', [
            'controller_name' => 'MaterielController',
            'materiaux1' => $materiaux1,
            'materiaux2' => $materiaux2,
            'getMax' => $allMateriaux[array_rand($allMateriaux, 1)]
        ]);
    }
}
