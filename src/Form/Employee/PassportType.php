<?php


namespace App\Form\Employee;


use App\Entity\Passport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class PassportType extends AbstractType
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
            ->add('type', ChoiceType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control'
                ],
                'choices' => [
                    ucfirst($this->translator->trans('standardowy')) => 'STANDARD',
                    ucfirst($this->translator->trans('biometryczny')) => 'BIO',
                ],
                'placeholder' => false,
                'data' => 'STANDARD'
            ])
            ->add('number', TextType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Passport::class,
        ]);
    }

}