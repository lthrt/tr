<?php

namespace TRBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WaveType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('position', null, ['label_attr' => ['class' => 'text-right']])
             ->add('align', null, ['label_attr' => ['class' => 'text-right']])
             ->add('description', null, ['label_attr' => ['class' => 'text-right']])
                             ->add('submit', SubmitType::class, ['label' => 'Submit'])
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TRBundle\Entity\Wave'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'trbundle_wave';
    }


}
