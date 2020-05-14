<?php


namespace App\Form\Employee;


use App\Entity\Company;
use App\Entity\Employee;
use App\Service\StringService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class GeneralEmployeeType extends AbstractType
{
    private $translator;

    function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

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
                'required'   => true,
                'attr' => [
                    'class' => 'form-control',
                ],
                'placeholder' => StringService::uc_first($this->translator->trans('wybierz płeć')),
                'choices' => [
                    StringService::uc_first($this->translator->trans('męska')) => 'MALE',
                    StringService::uc_first($this->translator->trans('żeńska')) => 'FEMALE',
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
            ->add('pipApplicationDate', DateType::class, [
                'required'   => false,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control js-datepicker',
                    'type' => 'text'
                ],
            ])
            ->add('baxtUA', ChoiceType::class, [
                'required'   => true,
                'attr' => [
                    'class' => 'form-control',
                ],
                'placeholder' => StringService::uc_first($this->translator->trans('wybierz status')),
                'choices' => [
                    StringService::uc_first($this->translator->trans('zatrudniony')) => 'HIRED',
                    StringService::uc_first($this->translator->trans('niezatrudniony')) => 'NOT_HIRED',
                    StringService::uc_first($this->translator->trans('do weryfikacji')) => 'NEED_VERIFICATION',
                ]
            ])
            ->add('company', EntityType::class, [
                'required'   => false,
                'class' => Company::class,
                'attr' => [
                    'class' => 'form-control',
                ],
                'placeholder' => StringService::uc_first($this->translator->trans('wybierz firmę')),
                'choice_label' => 'name',
            ])
            ->add('contact', ContactType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('update', SubmitType::class, [
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