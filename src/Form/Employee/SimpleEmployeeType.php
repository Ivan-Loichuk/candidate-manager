<?php


namespace App\Form\Employee;


use App\Entity\Employee;
use App\Service\StringService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class SimpleEmployeeType extends AbstractType
{
    private $translator;

    function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
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
            ->add('update_profile', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-primary pull-right btn-save',
                ],
                'label_format' => StringService::uc_first($this->translator->trans('dodaj')),
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}