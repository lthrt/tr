<?php

namespace TRBundle\Form\Atom;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

// This is for migration to single atom for plural and single case

class WaveAtom extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array                $options
    ) {}
    public function configureOptions(OptionsResolver $resolver)
    {
        $attr = function (Options $options) {
            $default = [];

            if (isset($options['new_attr'])) {
                return array_replace($default, $options['new_attr']);
            } else {
                return $default;
            }
        };

        $resolver->setDefaults(
            [
                'class'      => 'TRBundle:Wave',
                'label'      => 'Wave',
                'label_attr' => ['control-label'],
                'required'   => false,
                'attr'       => $attr,
                'new_attr'   => [],
            ]
        );

        $resolver->setDefined(['new_attr']);
    }

    public function getParent()
    {
        return EntityType::class;
    }
}
