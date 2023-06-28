<?php

namespace App\Form\Type;

use App\Entity\Johnson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class JohnsonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('colonnes', RangeType::class, [
                'label' => 'Nombre de colonnes',
                'attr' => [
                    'class' => 'form-range',
                    'min' => 1,
                    'max' => 5,
                    'step'=> 1
                ],
            ])
            ->add('decalage', RangeType::class, [
                'label' => 'Décalage de l\'angle des deux tracés de la colonne',
                'attr' => [
                    'class' => 'form-range',
                    'min' => 0,
                    'max' => 0.01,
                    'step'=> 0.0005
                ],
            ])
            ->add('ecart', NumberType::class, [
                'label' => 'Espace en pixels entre les traits'
            ])
            ->add('angle', NumberType::class, [
                'label' => 'Différence d\'angle entre deux traits : pi/'
            ])
            ->add('angledecoratif', RangeType::class, [
                'label' => 'Hasard de l\'angle des traits décoratifs',
                'attr' => [
                    'class' => 'form-range',
                    'min' => 0.001,
                    'max' => 0.01,
                    'step'=> 0.001
                ],
            ])
            ->add('rayondecoratif', RangeType::class, [
                'label' => 'Seuil minimum du hasard de la longueur des traits décoratifs',
                'attr' => [
                    'class' => 'form-range',
                    'min' => 0.4,
                    'max' => 0.9,
                    'step'=> 0.1
                ],
            ])
            ->add('decalagedecoratif', RangeType::class, [
                'label' => 'Hasard du décalage en hauteur des traits décoratifs par rapport aux tracés',
                'attr' => [
                    'class' => 'form-range',
                    'min' => 1,
                    'max' => 10,
                    'step'=> 1
                ],
            ])
            ->add('couleursaleatoires', CheckboxType::class, [
                'label' => 'Couleurs aléatoires',
                'required' => false,
                'attr' => [
                    'class' => 'form-check-input',
                    'checked' => 'checked'
                ],
            ])
            ->add('couleur1', ColorType::class, [
                'label' => 'Couleur 1'
            ])
            ->add('couleur2', ColorType::class, [
                'label' => 'Couleur 2'
            ])
            ->add('couleur3', ColorType::class, [
                'label' => 'Couleur 3'
            ])
            ->add('couleur4', ColorType::class, [
                'label' => 'Couleur 4'
            ])
            ->add('couleur5', ColorType::class, [
                'label' => 'Couleur 5'
            ])
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
            'data_class' => Johnson::class,
        ]);
    }
}