<?php


namespace App\Form\Company;

use App\Entity\Company;
use App\Service\StringService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class CompanyType extends AbstractType
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
            ->add('name', TextType::class, [
                'required'   => true,
                'attr' => [
                    'class' => 'form-control'
                ],
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
            'data_class' => Company::class,
        ]);
    }
}