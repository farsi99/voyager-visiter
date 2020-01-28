<?php

namespace App\Controller;

use App\Entity\Biens;
use App\Entity\Reserver;
use App\Form\ReserverType;
use App\Repository\ReserverRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ReserverController extends AbstractController
{
    /**
     * @Route("/reservation/{slug}", name="reserver")
     * @isGranted("ROLE_USER")
     */
    public function reserver(Biens $bien, Request $req, EntityManagerInterface $manager)
    {

        $reserver = new Reserver();

        $form = $this->createForm(ReserverType::class, $reserver);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $reserver->setUser($this->getUser())
                ->setBiens($bien);

            //Si les dates ne sont pas disponible, on envoie une erreure
            if (!$reserver->isBookableDates()) {
                $this->addFlash('warning', 'les dates choisis ne sont pas disponible sur cet annonce');
            } else {
                $manager->persist($reserver);
                $manager->flush();
                $this->addFlash('success', 'Reservation effectuée avec succès');
                return $this->redirectToRoute('show_reserver', ['id' => $reserver->getId()]);
            }
        }
        return $this->render('reserver/index.html.twig', [
            'bien' => $bien,
            'form' => $form->createView()

        ]);
    }

    /**
     * cette méthode traite l'afffichage d'une reservation
     * @Route("/reservation/numero/{id}", name="show_reserver")
     * @isGranted("ROLE_USER")
     */
    public function show_reserver(ReserverRepository $repo, $id)
    {
        if (is_numeric($id)) {
            return $this->render('reserver/show.html.twig', [
                'reserver' => $repo->findOneBy(['id' => $id])
            ]);
        } else {
            return $this->redirectToRoute('reserver');
        }
    }

    /**
     * Permet de voir l'ensemble des reservation d'un abonnée
     * @Route("/reservation/mes-reservations", name="all_reserver")
     * @isGranted("ROLE_USER")
     */
    public function show_all_reserver(ReserverRepository $repo)
    {
        $allbook = $repo->findByUser($this->getUser());
        dump($allbook);
        die;
        return $this->render("reserver/all.html.twig", [
            'allbook' => $allbook
        ]);
    }
}
