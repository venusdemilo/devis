<?php

namespace PL\FacturationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CarnetType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('nomCar')
            ->add('prnCar')
            ->add('cdeCar','number',array('attr'=>array('maxlength' => 5),))
            ->add('vilCar')
            ->add('melCar','email',array(
              'required'=>false,
            ))
            ->add('numerovoie',null,array(
              'mapped'=> false,
              'required'=>false,
            ))
            ->add('typevoie','choice',array(
              'mapped'=> false,
              'required'=>false,
              'choices'=>array(
                'allée'=>'allée',
                'avenue'=>'avenue',
                'boulevard'=>'boulevard',
                'chaussée'=>'chaussée',
                'chemin'=>'chemin',
                'contre-allée'=>'contre-allée',
                'grand-route'=>'grand-route',
                'grand-rue'=>'grand-rue',
                'impasse'=>'impasse',
                'passage'=>'passage',
                'place'=>'place',
                'plan'=>'plan',
                'pont'=>'pont',
                'promenade'=>'promenade',
                'piste'=>'piste',
                'quai'=>'quai',
                'rocade'=>'rocade',
                'rond-point'=>'rond-point',
                'route'=>'route',
                'rue'=>'rue',
                'voie'=>'voie',
              ),
              'placeholder' => false,
              'preferred_choices' => array('rue'),
              'choices_as_values' => true,

            ))
            ->add('nomvoie','text',array(
              'mapped'=> false,
              'required'=>false
            ))

            ->add('complement','text',array(
              'mapped'=> false,
              'required'=>false
            ))
            ->add('tel1','number',array(
              'mapped'=> false,
              'required'=>false,
              'attr'=>array('maxlength' => 2,),
            ))
            ->add('tel2','number',array(
              'mapped'=> false,
              'required'=>false,
              'attr'=>array('maxlength' => 2),
            ))
            ->add('tel3','number',array(
              'mapped'=> false,
              'required'=>false,
              'attr'=>array('maxlength' => 2),
            ))
            ->add('tel4','number',array(
              'mapped'=> false,
              'required'=>false,
              'attr'=>array('maxlength' => 2,),
            ))
            ->add('tel5','number',array(
              'mapped'=> false,
              'required'=>false,
              'attr'=>array('maxlength' => 2),
            ))
            ->add('tieCar','checkbox',array(
              'required'=>false,
            ))
            ->add('Enregistrer','submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PL\FacturationBundle\Entity\Carnet'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pl_facturationbundle_carnet';
    }
}
