<?php

namespace FCOM\IcomBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgramaGenerarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('horaInicio')
                ->add('horaFinal')
                ->add('actividad', TextareaType::class, array(
                      'attr' => array('class' => 'tinymce'),))
                ->add('lugar')
                ->add('dia', EntityType::class, [
                    'class' => 'FCOMIcomBundle:Dia',
                    'label' => 'Dia',
                    'query_builder' => function(EntityRepository $d) {
                        return $d->createQueryBuilder('d');},
                    'choice_label' => 'getDia',
                ])
                ->add('save', 'submit', array('label' => 'Guardar'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FCOM\IcomBundle\Entity\ProgramaGenerar'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fcom_icombundle_programagenerar';
    }


}
