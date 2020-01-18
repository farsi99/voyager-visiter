<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/logout", name="account_logout")
     */
    public function logout()
    {
    }

    /**
     * cette méthode traite l'affichage d'un profil abonné
     * @Route("/profile", name="account_profile")
     * @IsGranted("ROLE_USER")
     */
    public function profile()
    {
        $user = $this->getUser();
        dump($user);
    }
}
