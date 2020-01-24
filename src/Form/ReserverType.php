<?php

namespace App\Form;

use App\Entity\Reserver;
use App\Form\ApplicationType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReserverType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut', DateType::class, $this->getConfiguration('Date arrivée', 'date entrée', 'form-control', null, ['widget' => "single_text"]))
            ->add('dateFin', DateType::class, $this->getConfiguration('Date de départ', 'Date sortie', 'form-control', null, ['widget' => "single_text"]))
            ->add('infosuplementaire', TextareaType::class, $this->getConfiguration('Une démande particulière ou un commentaire ?', 'une information suplémentaire sur votre reservation', 'form-control', 4));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reserver::class,
        ]);
    }
}
