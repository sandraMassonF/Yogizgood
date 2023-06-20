<?php

namespace App\Form;

use App\Entity\Session;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('duration', TextType::class, [
                'label' => 'Durée'
            ])

            ->add('date',DateTimeType::class, [
                'label' => 'Date et Heure',
                'widget' => 'single_text'
            ])

            ->add('places', TextType::class, [
                'label' => 'Nombre de places',
                'attr' => [
                'class' => 'formulaire'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
