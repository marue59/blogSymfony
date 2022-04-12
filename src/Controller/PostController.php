<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{  
    #[Route('/post/index', name: 'post_index')]
    public function index(PostRepository $postRepo, CategoryRepository $categoryRepo): Response
    {
        return $this->render('post/index.html.twig', [
            'posts' => $postRepo->findAll(),
            'category' => $categoryRepo->findAll()]);
    }

    #[Route('/post/new', name: 'post_new')]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger
    ): Response 
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->handlePictures($form->get('pictures'), $slugger);

            //ajouter slug.
            $post->setSlug($slugger->slug($post->getName()));


            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/new.html.twig', [
            'post' => $post,
            'form' => $form
        ]);
    }

    public function handlePictures($pictures, $slugger)
    {
        // $picture = PictureType
        foreach ($pictures as $picture) {
            // $model = Picture
            $model = $picture->getData();
            // $picturFile = UploadFile // upload fait automatiquement grace au FileType
            $pictureFile = $picture->get('path')->getData();

            if ($pictureFile) {
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pictureFile->guessExtension();

                try {
                    $pictureFile->move(
                        $this->getParameter('kernel.project_dir') . '/public/images/picture_upload/',
                        $newFilename
                    );
                    $model->setPath($newFilename);
                } catch (FileExeption $e) {
                    $this->addFlash('danger', "Nous avons rencontrés un probleme");
                }
            }
        }
    }
    #[Route('/post/{slug}', name: 'post_show')]
    public function show(Post $post): Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $post]);
    }
}
