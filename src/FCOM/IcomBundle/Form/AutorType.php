<?php

namespace FCOM\IcomBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AutorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre')
                ->add('apellidos')
                ->add('correo', EmailType::class)
                ->add('pais', EntityType::class, array(
                    'class' => 'FCOMIcomBundle:Pais',
                    'query_builder' => function(EntityRepository $p){
                        return $p->createQueryBuilder('p');},
                    'choice_label' => 'getPais',
                    'placeholder' => '---Seleccione un valor ---'
                ))
                ->add('tipoAutor', EntityType::class, array(
                    'class' => 'FCOMIcomBundle:TipoAutor',
                    'query_builder' => function(EntityRepository $a){
                        return $a->createQueryBuilder('a');},
                    'choice_label' => 'getTipoAutor',
                    'placeholder' => 'Seleccione un valor...'))
                ->add('perteneceInstitucion')
                ->add('institucion')
                ->add('save', SubmitType::class, array('label' => 'Guardar'));

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FCOM\IcomBundle\Entity\Autor'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fcom_icombundle_autor';
    }


}
