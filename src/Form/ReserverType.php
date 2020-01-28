<?php

namespace App\Form;

use App\Entity\Reserver;
use App\Form\ApplicationType;
use App\Form\DataTransformer\FrenchToDateTimeTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReserverType extends ApplicationType
{
    private $transformer;
    public function __construct(FrenchToDateTimeTransformer $tranfromer)
    {
        $this->transformer = $tranfromer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut', TextType::class, $this->getConfiguration('Date arrivée', 'date entrée', 'form-control', null))
            ->add('dateFin', TextType::class, $this->getConfiguration('Date de départ', 'Date sortie', 'form-control', null))
            ->add('infosuplementaire', TextareaType::class, $this->getConfiguration('Une démande particulière ou un commentaire ?', 'une information suplémentaire sur votre reservation', 'form-control', 4, ['required' => false]));
        $builder->get('dateDebut')->addModelTransformer($this->transformer);
        $builder->get('dateFin')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reserver::class,
        ]);
    }
}
