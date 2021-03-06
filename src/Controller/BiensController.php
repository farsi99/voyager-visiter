<?php

namespace App\Controller;

use App\Entity\Biens;
use App\Repository\BiensRepository;
use App\Service\Pagination;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BiensController extends AbstractController
{
    /**
     * @Route("/biens/{page<\d+>?1}", name="biens")
     */
    public function index(BiensRepository $repo, $page, Pagination $pagination)
    {
        $pagination->setEntityClass(Biens::class)
            ->setPage($page);
        return $this->render('biens/index.html.twig', [
            'biens' => $pagination,
        ]);
    }

    /**
     * cette méthode traite l'affichage d'un bien
     * @Route("/{slug}", name="detail_biens")
     */
    public function detail(BiensRepository $req, $slug)
    {
        return $this->render('biens/detail.html.twig', [
            'data' => $req->findBienBySlug($slug)
        ]);
    }
}
