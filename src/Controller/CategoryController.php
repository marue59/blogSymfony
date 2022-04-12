<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Category;
use App\Repository\PostRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/category/{slug}', name: 'category_show')]
    public function show(Category $category, 
    CategoryRepository $categoryRepo, 
    PostRepository $postRepo): Response
    {
        return $this->render('category/show.html.twig',
        ['category'=> $category,
        'categories' => $categoryRepo->findAll(),
        'posts' => $postRepo->findAll(),]);
    }
}
