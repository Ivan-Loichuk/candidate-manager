<?php


namespace App\Form\Employee;


use App\Entity\Contract;
use App\Service\StringService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContractType extends AbstractType
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
            ->add('dateFrom', DateType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control js-datepicker',
                    'type' => 'text',
                ],
                'widget' => 'single_text',
            ])
            ->add('dateTo', DateType::class, [
                'required'   => false,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control js-datepicker',
                    'type' => 'text',
                ],
            ])
            ->add('type', ChoiceType::class, [
                'required'   => true,
                'attr' => [
                    'class' => 'form-control',
                ],
                'placeholder' => StringService::uc_first($this->translator->trans('wybierz rodzaj umowy')),
                'choices' => [
                    $this->translator->trans('Umowa o pracę') => 'UoP',
                    $this->translator->trans('Zlecenia') => 'ZLECENIA',
                    $this->translator->trans('B2B') => 'B2B',
                ]
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contract::class,
        ]);
    }
}