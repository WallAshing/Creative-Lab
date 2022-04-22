<?php

namespace App\Controller;

use App\Repository\PostCateogiesRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(PostRepository $repository, PostCateogiesRepository $cateogiesRepository): Response
    {
        $allPost = $repository->findAll();
        $postTuto = [];
        $postProjets = [];
        $postActu = [];
        $categoryTuto = $cateogiesRepository->findWithName("Tutoriels");
        $categoryProjet = $cateogiesRepository->findWithName("Projets");
        $categoryActualite = $cateogiesRepository->findWithName("Actualite Techno");
        foreach ($allPost as $post) {
            if ($post->getCategory()->getName() === 'Tutoriels') {
                $postTuto[] = $post;
            } elseif ($post->getCategory()->getName() === 'Projets') {
                $postProjets[] = $post;
            } elseif ($post->getCategory()->getName() === 'Actualite Techno') {
                $postActu[] = $post;
            }
        }

        $postTuto = array_slice($postTuto, 0, 3);
        $postProjets = array_slice($postTuto, 0, 3);
        $postActu = array_slice($postTuto, 0, 3);



        return $this->render('blog/index.html.twig', [
            'postsTuto' => $postTuto,
            'soonerTutos' => $repository->sortByDate($categoryTuto, "DESC", 2),
            'postsProjetsDESC' => $repository->sortByDate($categoryProjet, "DESC", 2),
            'postsProjetsASC' => $repository->sortByDate($categoryProjet, "ASC", 2),
            'allPostProjets' => $repository->findAllByCategory($categoryProjet, 50),
            'postsActu' => $repository->findAllByCategory($categoryActualite, 4),
            'singlePostActu' => $repository->getOneByDate($categoryActualite, "DESC")
        ]);
    }

    #[Route('/blog/{id}', name: 'app_blog_show')]
    public function show(PostRepository $postRepository, $id): Response
    {
        $post = $postRepository->findOneBy(['id' => $id]);
        $postLike = $postRepository->getSimilar($post->getCategory(), $post->getId());
        return $this->render('article/index.html.twig', [
            'post' => $post,
            'postLikes' => $postLike
        ]);
    }
}
