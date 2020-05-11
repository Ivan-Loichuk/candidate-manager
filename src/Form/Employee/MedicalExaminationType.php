<?php


namespace App\Form\Employee;

use App\Entity\MedicalExamination;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicalExaminationType extends AbstractType
{
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
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MedicalExamination::class,
        ]);
    }


}