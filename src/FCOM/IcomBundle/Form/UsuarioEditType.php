<?php

namespace FCOM\IcomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class UsuarioEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username')
                ->add('nombre')
                ->add('apellidos')
                ->add('email')
                ->add('role', ChoiceType::class, array(
                'choices' => array(
                    'ROLE_USUARIO' => 'ROLE_USUARIO',
                    'ROLE_EDITOR' => 'ROLE_EDITOR',
                    'ROLE_EVALUADOR' => 'ROLE_EVALUADOR',
                    'ROLE_CODGENERAR' => 'ROLE_CODGENERAR',
                    'ROLE_ADMIN' => 'ROLE_ADMIN',

                ),
                'choices_as_values' => true,
                ))
                ->add('isActive', CheckboxType::class, array(
                ));


        }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FCOM\IcomBundle\Entity\Usuario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fcom_icombundle_usuario';
    }


}
