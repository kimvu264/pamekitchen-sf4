<?php

namespace App\Form;

use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class IngredientFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite',IntegerType::class,[
                'label'=>'Quantité en grammes :',
                'constraints'=>[
                    new notBlank(['message'=>'La quantité des ingrédients est manquante']),
                    new Length([
                        'max'=>3,
                        'maxMessage'=>'La quantité de votre ingrédient ne peut comporter plus de 3 caractères.'
                    ])
                ]
            ])

            ->add('nom',TextType::class,[
                'label'=>'Ingrédient par unité :',
                'constraints'=>[
                    new notBlank(['message'=>'Le nom des ingrédients est manquant']),
                    new Length([
                        'max'=>100,
                        'maxMessage'=>'Le nom de votre ingrédient ne peut comporter plus de 100 caractères.'
                    ])
                ]   
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>Ingredient::class
        ]);
    }
}