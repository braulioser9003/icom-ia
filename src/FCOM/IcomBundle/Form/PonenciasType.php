<?php

namespace FCOM\IcomBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PonenciasType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titulo', 'text')
                ->add('resumen', 'textarea')
                ->add('palabraClave', 'collection', array(
                      'type' => new PalabraClaveType(),
                      'allow_add'    => true,
                      'allow_delete' => true,
                      'by_reference' => false,
                ))
                ->add('tematica', 'entity', array(
                      'class' => 'FCOMIcomBundle:Tematica',
                      'query_builder' => function(EntityRepository $tm){
                          return $tm->createQueryBuilder('t');},
                      'choice_label' => 'getTematica',
                      'placeholder' => '------------------------------------------------------Seleccione un Valor-----------------------------------------------------'
                      ))
                ->add('estado', 'entity', array(
                      'class' => 'FCOMIcomBundle:Estado',
                      'query_builder' => function(EntityRepository $e){
                          return $e->createQueryBuilder('e');},
                      'choice_label' => 'getEstado'
                      ))
                ->add('modalidad', ChoiceType::class, array(
                    'choices' => array(
                        'Ponencias' => 'Ponencia',
                        'Poster' => 'Poster',
                    ),
                    'choices_as_values' => true,
                ))
                ->add('estado', 'entity', array(
                    'class' => 'FCOMIcomBundle:Estado',
                    'query_builder' => function(EntityRepository $e){
                        return $e->createQueryBuilder('e');},
                    'choice_label' => 'getEstado'
                ))
                ->add('save', 'submit', array('label' => 'Guardar'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FCOM\IcomBundle\Entity\Ponencias'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fcom_icombundle_ponencias';
    }


}
