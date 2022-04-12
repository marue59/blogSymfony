<?php

namespace App\Controller;

use App\Entity\Plateforme;
use App\Entity\VeilleTechno;
use App\Repository\PlateformeRepository;
use App\Repository\VeilleTechnoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_index')]
    public function index(VeilleTechnoRepository $veilleTechnoRepo,
    PlateformeRepository $plateformeRepo): Response
    {
        return $this->render('admin/index.html.twig', [
             'veilleTechno' => $veilleTechnoRepo->findAll(),
             'plateformes' => $plateformeRepo->findAll()
        ]);
    }

    #[Route('/admin/list/reseaux', name: 'admin_list_plateforme')]
    public function list_plateforme(PlateformeRepository $plateformeRepo): Response
    {
        return $this->render('admin/list_plateforme.html.twig', [
             'plateformes' => $plateformeRepo->findAll()
        ]);
    }

    #[Route('/admin/list/veilleTechno', name: 'admin_list_veilleTechno')]
    public function list_veilleTechno(VeilleTechnoRepository $veilleTechnoRepo): Response
    {
        return $this->render('admin/list_veilleTechno.html.twig', [
            'veilleTechnos' => $veilleTechnoRepo->findAll()
        
        ]);
    }     
    
    #[Route('/admin/list/veilleTechno/{slug}', name: 'admin_list_veilleTechno_slug')]
    public function list_veilleTechno_slug(VeilleTechno $veilleTechno): Response
    {
        return $this->render('admin/show_veilleTechno.html.twig', [
             'veilleTechno' => $veilleTechno
        ]);
    }  
}
