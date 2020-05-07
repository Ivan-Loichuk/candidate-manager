<?php


namespace App\Forms\Candidate;


use App\Entity\Employee;
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
                'required'   => true,
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('lastname', TextType::class, [
                'required'   => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('email', TextType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('phoneNumber', TextType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('viber', TextType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('skype', TextType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('profession', TextType::class, [
                'required'   => false,
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
            ->add('aboutCandidate', TextareaType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control about-candidate',
                ],
            ])
            ->add('birthplace', BirthplaceType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('nationality', TextType::class, [
                'required'   => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('dateOfBirth', DateType::class, [
                'required'   => true,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control js-datepicker',
                    'type' => 'text'
                ],
            ])
            ->add('update_profile', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-info btn-fill pull-right btn-save',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}