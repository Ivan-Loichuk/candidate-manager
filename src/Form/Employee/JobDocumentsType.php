<?php


namespace App\Form\Employee;


use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobDocumentsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('medicalExamination', CollectionType::class, [
                'entry_type' => MedicalExaminationType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'delete_empty' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ])
            ->add('safetyTraining', CollectionType::class, [
                'entry_type' => SafetyTrainingType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'delete_empty' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ])
            ->add('delegationList', CollectionType::class, [
                'entry_type' => DelegationListType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'delete_empty' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ])
            ->add('contract', CollectionType::class, [
                'entry_type' => ContractType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'delete_empty' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ])
            ->add('permission', CollectionType::class, [
                'entry_type' => PermissionType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'delete_empty' => true,
                'by_reference' => false,
                'allow_delete' => true,
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