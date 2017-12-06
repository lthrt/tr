<?php

namespace TRBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StateType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('sheep', null, ['label_attr' => ['class' => 'text-right']])
             ->add('dogs', null, ['label_attr' => ['class' => 'text-right']])
             ->add('pigs', null, ['label_attr' => ['class' => 'text-right']])
             ->add('resolved', null, ['label_attr' => ['class' => 'text-right']])
             ->add('closed', null, ['label_attr' => ['class' => 'text-right']])
             ->add('triggered', null, ['label_attr' => ['class' => 'text-right']])
             ->add('game', null, ['label_attr' => ['class' => 'text-right']])
             ->add('eigenfunction', null, ['label_attr' => ['class' => 'text-right']])
             ->add('next', null, ['label_attr' => ['class' => 'text-right']])
             ->add('prev', null, ['label_attr' => ['class' => 'text-right']])
                             ->add('submit', SubmitType::class, ['label' => 'Submit'])
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TRBundle\Entity\State'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'trbundle_state';
    }


}
