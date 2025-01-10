<?php

namespace App\Form;

use App\Entity\BookRead;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookReadFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('book_id', ChoiceType::class, [
                'choices' => [
                    'Livre 1' => 1,
                    'Livre 2' => 2,
                ],
                'label' => 'Livre',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Mes notes',
                'required' => false,
            ])
            ->add('rating', ChoiceType::class, [
                'choices' => [
                    1 => 1,
                    1.5 => 1.5,
                    2 => 2,
                    2.5 => 2.5,
                    3 => 3,
                    3.5 => 3.5,
                    4 => 4,
                    4.5 => 4.5,
                    5 => 5,
                ],
                'label' => 'Note',
            ])
            ->add('is_read', CheckboxType::class, [
                'label' => 'Lecture terminée',
                'required' => false,
            ]);

            // We will fill created_at and updated_at automatically in the controller, so no need to add them here
            // .add('created_at', null, ['widget' => 'single_text']) - No need to add this manually

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookRead::class,
        ]);
    }
}
