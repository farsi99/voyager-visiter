<?php

namespace App\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager as PersistenceObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccountController extends AbstractController
{
    /**
     * @Route("/login", name="account_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        return $this->render('account/login.html.twig', [
            'lastUser' => $utils->getLastUsername(),
            'error' => $utils->getLastAuthenticationError()
        ]);
    }

    /**
     * cette méthode traite l'affichage d'un profil abonné
     * @Route("/profile", name="account_profile")
     * @IsGranted("ROLE_USER")
     * 
     * @return Response
     */
    public function profile()
    {
        $user = $this->getUser();
        dump($user);
        return $this->render('account/profile.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/logout", name="account_logout")
     */
    public function logout()
    {
    }
}
