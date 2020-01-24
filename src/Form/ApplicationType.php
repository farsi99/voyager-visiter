<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;

class ApplicationType extends AbstractType
{
    /**
     * Permet d'avoir la configuration de base d'un champ
     *
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return void
     */
    protected function getConfiguration($label, $placeholder, $class = null, $cols = null, $options = [])
    {
        return array_merge([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder,
                'class' => $class,
                'cols' => $cols
            ]
        ], $options);
    }
}
