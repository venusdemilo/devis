<?php

namespace PL\FacturationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CarnetUpdateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('statut','entity',array(
              'class'=>"PLFacturationBundle:Statut",
              'property'=>'libSta',
              'multiple'=>true,
              'expanded'=>true,
              'mapped'=>false,
              'required'=>true

            ))
            ->add('statut','entity',array(
              'class'=>"PLFacturationBundle:Statut",
              'property'=>'libSta',
              'multiple'=>true,
              'expanded'=>true,
              'mapped'=>true, //permet d'atteindre les setter et getter parents
              'required'=>true

            ))

        ;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'pl_facturationbundle_carnet_update';
    }

    public function getParent()
    {
      return new CarnetType();
    }
}
