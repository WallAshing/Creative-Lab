<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(PostRepository $repository): Response
    {
        $allPost = $repository->findAll();
        $postTuto = [];
        $postProjets = [];
        $postActu = [];
        foreach ($allPost as $post) {
            if ($post->getCategory()->getName() === 'Tutoriels') {
                $postTuto[] = $post;
            } elseif ($post->getCategory()->getName() === 'Projets') {
                $postProjets[] = $post;
            } elseif ($post->getCategory()->getName() === 'Actualite Techno') {
                $postActu[] = $post;
            }
        }

        dd($postActu);

        return $this->render('blog/index.html.twig', [
            'posts' => $repository->findAll(),
        ]);
    }
}
