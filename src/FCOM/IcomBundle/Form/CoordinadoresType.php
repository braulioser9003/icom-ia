<?php

namespace FCOM\IcomBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoordinadoresType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre')
                ->add('apellidos')
                ->add('gradoCientifico')
                ->add('tematica', 'entity', array(
                    'class' => 'FCOMIcomBundle:Tematica',
                    'query_builder' => function(EntityRepository $tm){
                        return $tm->createQueryBuilder('t');},
                    'choice_label' => 'getTematica',
                    'placeholder' => '------------------------------------------------------Seleccione un Valor-----------------------------------------------------'
                ))
                ->add('save', 'submit', array('label' => 'Guardar'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FCOM\IcomBundle\Entity\Coordinadores'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fcom_icombundle_coordinadores';
    }


}
