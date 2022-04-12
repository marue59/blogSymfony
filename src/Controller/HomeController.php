<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PostRepository $postRepository, Request $request): Response
    {
        $page = $request->get('page', 1);

        $limit = 10;
        
        $posts = $postRepository->createQueryBuilder('p')
            ->setFirstResult(($page * $limit) - $limit)
            ->setMaxResults($limit)
            ->getQuery()->getResult();

        if ($request->isXmlHttpRequest()) {
            return $this->render(
                'home/index.html.twig',
                ['posts' => $posts]
            );
        }
        return $this->render('home/index.html.twig', [
            'posts' => $postRepository->findAll()]);
    }
}
