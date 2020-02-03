<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite', ChoiceType::class, [
                'choices' => ['Mr' => 'Mr', 'Mme' => 'Mme'],
            ], $this->getConfiguration('Civilité', 'civilite', 'form-control', null))
            ->add('nom', TextType::class, $this->getConfiguration('Nom', 'Votre nom', 'form-control', null))
            ->add('prenom', TextType::class, $this->getConfiguration('Prénom', 'Votre prenom', 'form-control', null))
            ->add('email', TextType::class, $this->getConfiguration('E-mail', 'Votre email', 'form-control', null))
            ->add('motpasse', PasswordType::class, $this->getConfiguration('Mot de passe', 'Votre mot de passe', 'form-control', null))
            ->add('confirm_password', PasswordType::class, $this->getConfiguration('Confirmez le mot de passe', 'Confirmez votre mot de passe', 'form-control', null));
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
