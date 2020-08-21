<?php

namespace App\Form;

use App\Entity\Example;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExampleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file')
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'large-field'
                ]
            ])
            ->add('datetime', DateTimeType::class, [
                'data' => new \DateTimeImmutable()
          //      'months' => range(date('m'), 12)
            ])
            ->add('pets', ChoiceType::class, [
                'choices' => [
                    'dogs' => 0,
                    'cats' => 1,
                    'no pets' => 2
                ],
                'expanded' => true,
                'multiple' => false//default value
            ])
            ->add('user')
            ->add('address', AddressType::class)
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Example::class,
        ]);
    }
}
