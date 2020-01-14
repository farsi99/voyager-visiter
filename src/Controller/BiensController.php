<?php

namespace App\Controller;

use App\Entity\Biens;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BiensController extends AbstractController
{
    /**
     * @Route("/biens", name="biens")
     */
    public function index()
    {
        return $this->render('biens/index.html.twig', [
            'controller_name' => 'BiensController',
        ]);
    }

    /**
     * cette méthode traite l'affichage d'un bien
     * @Route("/{slug}", name="detail_biens")
     */
    public function detail(Biens $bien)
    {
        return $this->render('biens/detail.html.twig', [
            'bien' => $bien
        ]);
    }
}
