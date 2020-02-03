<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\ReserverRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
    public function profile(ReserverRepository $reserve)
    {
        $user = $this->getUser();
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

    /**
     * Cette methode permet d'enregister un utilisateur
     * @Route("/register", name = "acount_register")
     * @return Response
     */
    public function register(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = New User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $user->setDateInscription(new \DateTime());
            $hash = $encoder->encodePassword($user, $user->getMotpasse());
            $user->setMotpasse($hash);
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', 'Votre compte est crée avec succès, vous pouvez maintenat vous connectez!');
            $this->redirectToRoute('account_login');
        } 

        return $this->render('account/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
