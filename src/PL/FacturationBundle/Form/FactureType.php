<?php

namespace PL\FacturationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FactureType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dpfFac','datetime',array(
              'attr'=>array(),
              'date_widget'=>'single_text',
              'time_widget'=>'single_text',
              'with_minutes'=>'false',
              'date_format'=>'dd/MM/yyyy'
              //'input'=>'string',
              //'html5'=>false,
            //  'placeholder' => 'Select a value',
            ))
            ->add('totFac','number',array(
              'attr'=>array('readonly'=>'readonly',),
            ))
            //->add('solFac')
        //    ->add('datFac')
          // ->add('arcFac')
          //  ->add('vldFac')
            //->add('carnet')
            //->add('devis')
            //->add('user')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PL\FacturationBundle\Entity\Facture'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pl_facturationbundle_facture';
    }
}
