<?php

namespace PL\FacturationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FamilleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('libFam','text')
            ->add('drtFam','choice',array(

              'required'=>true,

              'choices'=>array(
                'private'=>'private',
                'hn'=>'hn',
                'public'=>'public',
              ),
              'placeholder' => false,
              'choices_as_values' => true,
              'preferred_choices' => array('private'),

            ))
            ->add('enregistrer','submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PL\FacturationBundle\Entity\Famille'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pl_facturationbundle_famille';
    }
}
