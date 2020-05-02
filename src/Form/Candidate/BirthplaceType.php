<?php

namespace App\Form\Candidate;

use App\Entity\Birthplace;
use App\Entity\Candidate;
use App\Entity\Country;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BirthplaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'nicename',
                'placeholder' => 'Choose a country',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Birthplace::class,
        ]);
    }
}