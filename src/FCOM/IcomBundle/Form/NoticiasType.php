<?php

namespace FCOM\IcomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class NoticiasType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titulo')
            ->add('resumen', 'textarea')
            ->add('contenido', 'textarea')
            ->add('etiqueta')
            ->add('publicado', 'checkbox')
            ->add('save', 'submit', array('label' => 'Crear Noticia'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FCOM\IcomBundle\Entity\Noticias'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fcom_icombundle_noticias';
    }


}
