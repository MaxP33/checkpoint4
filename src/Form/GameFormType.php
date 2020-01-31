<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Mise', TextType::class, [
                'label'       => false,
                'attr' => ['placeholder' => 'Entrez votre mise'],

            ])
            ->add('Couleur', ChoiceType::class, [
                'choices'     => ['Rouge' => 'Rouge', 'Noir' => 'Noir'],
                'label'       => false,
                'placeholder' => 'Choisissez-votre couleur'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
