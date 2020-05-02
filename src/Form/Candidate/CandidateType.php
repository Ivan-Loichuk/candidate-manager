<?php


namespace App\Forms\Candidate;


use App\Entity\Candidate;
use App\Form\Candidate\BirthplaceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('email', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('phoneNumber', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('viber', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('skype', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('profession', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('gender', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'choices' => [
                    'MALE' => 'MALE',
                    'FEMALE' => 'FEMALE',
                ]
            ])
            ->add('jobSummary', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('birthplace', BirthplaceType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('update_profile', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-info btn-fill pull-right',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}