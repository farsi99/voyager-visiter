<?php

namespace App\Controller;

use App\Entity\Biens;
use App\Entity\Reserver;
use App\Form\ReserverType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ReserverController extends AbstractController
{
    /**
     * @Route("/reserver/{slug}", name="reserver")
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

            $manager->persist($reserver);
            $manager->flush();
            $this->addFlash('success', 'Reservation effectuée avec succès');
            return $this->redirectToRoute('reserver_success', ['id' => $reserver->getId()]);
        }
        return $this->render('reserver/index.html.twig', [
            'bien' => $bien,
            'form' => $form->createView()

        ]);
    }
}
