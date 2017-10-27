<?php

namespace PL\FacturationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProduitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('refProd')
            ->add('libProd')
            ->add('ttcProd','number', array('required'=>true))
            ->add('infoproduit','entity',array(
                  'class' => 'PLFacturationBundle:Infoproduit',
                  'property' => 'lbcInf',
                  'multiple' => false,
                  'required' =>true,
                  'mapped' =>true,
                  'empty_value' => 'Type d\'information liée au produit'
                  )
                )
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PL\FacturationBundle\Entity\Produit'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pl_facturationbundle_produit';
    }
}
