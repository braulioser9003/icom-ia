<?php

namespace FCOM\IcomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DatosGeneralesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tituloSitio')->add('fechaInicio')->add('fechaFinal')->add('cuentaTuitter')->add('cuentaFacebook')->add('correoTcom')->add('estadoPrograma');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FCOM\IcomBundle\Entity\DatosGenerales'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fcom_icombundle_datosgenerales';
    }


}
