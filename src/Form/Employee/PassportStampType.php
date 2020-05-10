<?php


namespace App\Form\Employee;


use App\Entity\PassportStamp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PassportStampType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateOfDeparture', DateType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('dateOfArrival', DateType::class, [
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
            'data_class' => PassportStamp::class,
        ]);
    }
}