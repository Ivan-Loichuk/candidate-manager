<?php


namespace App\Form\Employee;


use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
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
            ->add('gender', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'choices' => [
                    'MALE' => 'MALE',
                    'FEMALE' => 'FEMALE',
                ]
            ])
            ->add('dateOfBirth', DateType::class, [
                'required'   => false,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control js-datepicker',
                    'type' => 'text'
                ],
            ])
            ->add('dateOfArrival', DateType::class, [
                'required'   => false,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control js-datepicker',
                    'type' => 'text'
                ],
            ])
            ->add('dateOfDeparture', DateType::class, [
                'required'   => false,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control js-datepicker',
                    'type' => 'text'
                ],
            ])
            ->add('contact', ContactType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control',
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