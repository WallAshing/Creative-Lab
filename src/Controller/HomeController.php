<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Repository\ImprimanteRepository;
use App\Repository\PostCateogiesRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PostRepository $repository, PostCateogiesRepository $cateogiesRepository, ImprimanteRepository $imprimanteRepository, EventRepository $eventRepository): Response
    {
        $categoryActu = $cateogiesRepository->findWithName("Actualite Techno");
        $postsActualite = $repository->sortByDate($categoryActu, "DESC", 3);
        $allImprimanteBeforeFilter = $imprimanteRepository->findAll();
        $allImprimante = [];
        foreach ($allImprimanteBeforeFilter as $imprimante)
        {
            $allImprimante[] = $imprimante->getName();
        }
        $allImprimante = array_unique($allImprimante);




        return $this->render('home/index.html.twig', [
            'postsActualite' => $postsActualite,
            'allImprimantes' => $allImprimante,
            'events' => $eventRepository->findByDate(new \DateTime())
        ]);
    }
}
