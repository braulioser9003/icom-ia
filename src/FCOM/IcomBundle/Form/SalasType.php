<?php

namespace FCOM\IcomBundle\Form;

use FCOM\IcomBundle\Entity\Dia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use AppBundle\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Date;


class SalasType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre')
                ->add('capacidad')
                ->add('horaInicio')
                ->add('horaFinal')
                ->add('tipoActividad', ChoiceType::class, array(
                    'choices' => array(
                        'Trabajo en Comisiones' => 'Trabajo en Comisiones',
                        'Publicación de Poster' => 'Publicación de Poster',
                    ),
                    'choices_as_values' => true,
                ))
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
            'data_class' => 'FCOM\IcomBundle\Entity\Salas'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fcom_icombundle_salas';
    }


}
