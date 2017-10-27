<?php

namespace PL\FacturationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FamilleUpdateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('save','submit')->add('modifier','submit')
        ;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'pl_facturationbundle_famille_update';
    }

    public function getParent()
    {
      return new FamilleType();
    }
}
