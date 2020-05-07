<?php


namespace App\Form\Employee;


use App\Entity\Contact;
use App\Entity\Employee;
use App\Entity\PhoneNumber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('viber', TextType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('phoneNumber', CollectionType::class, [
                'entry_type' => PhoneNumberType::class,
                'entry_options' => ['label' => false],
                'block_name' => 'number_lists',
                'allow_add' => true,
                'delete_empty' => true,
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}