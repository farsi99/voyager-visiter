<?php

namespace App\Controller;

use App\Repository\BiensRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(BiensRepository $req, UserRepository $requ)
    {
        return $this->render('accueil/index.html.twig', [
            'biens' => $req->tophebergement(6),
            'hotes' => $requ->bestHote(),
            'nbhotel' => count($req->findByTypeBien('Hôtel')),
            'nbhote' => count($req->findByTypeBien('Particulier')),
            'nbuser' => count($requ->findAll())

        ]);
    }
}
