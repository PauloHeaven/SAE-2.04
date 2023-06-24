<?php

namespace App\Form\Type;

use App\Entity\Nees;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class NeesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amplitude', RangeType::class, [
                'attr' => [
                    'class' => 'form-range',
                    'min' => 0,
                    'max' => 1,
                    'step'=> 0.05
                ],
            ])
            ->add('angle', RangeType::class, [
                'attr' => [
                    'class' => 'form-range',
                    'min' => 0,
                    'max' => 1,
                    'step'=> 0.05
                ],
            ])
            ->add('colonnes', NumberType::class, ['attr' => [
                'class' => 'form-text',
                'placeholder' => '10',
                'min' => 1
            ],
            'html5' => True,
            'constraints' => [
                new NotBlank([
                    "message" => "Veuillez entrer un nombre"
                ]),
            ]])
            ->add('lignes', NumberType::class, ['attr' => [
                'class' => 'form-text',
                'placeholder' => '10',
                'min' => 1
            ],
            'html5' => True,
            'constraints' => [
                new NotBlank([
                    "message" => "Veuillez entrer un nombre"
                ]),
            ]])
            ->add('calculer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->add('imprimer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-danger'
                ]
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Nees::class,
        ]);
    }
}