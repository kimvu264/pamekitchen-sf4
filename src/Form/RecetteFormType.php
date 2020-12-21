<?php

namespace App\Form;

use App\Entity\Ingredient;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RecetteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'constraints'=>[
                    new notBlank(['message'=>'Le nom de la recette est manquant']),
                    new Length([
                        'max'=>100,
                        'maxMessage'=>'Le nom de votre recette ne peut comporter plus de {{limit}} caractères.'
                    ])

                ]
            ])
            ->add('description',TextType::class,[
                'constraints'=>[
                    new notBlank(['message'=>'Merci de mettre une brève description de votre recette ']),
                    new Length([
                        'max'=>100,
                        'maxMessage'=>'Votre description de votre recette de 100 caractères.'
                    ])
                ]
            ])
            ->add('nbr_pers',IntegerType::class,[
                'constraints'=>[
                    new notBlank(['message'=>'Merci de renseigner le nombre de personnes pour cette recette'])
                ]
            ])
            ->add('tps_total',IntegerType::class)
            ->add('tps_cuisson',IntegerType::class)
            ->add('tps_prepare',IntegerType::class)
            ->add('preparation',TextareaType::class,[
                'constraints'=>[
                    new notBlank(['message'=>'Merci de remplir les étapes de votre recette'])
                ]
            ])
            // ->add('video_file',FileType::class,[
            //     'mapped'=>false
            // ])
            ->add('ingredients',CollectionType::class,[
                'entry_type'=> Ingredient::class,
                'constraints'=>[
                    new notBlank(['message'=>'Merci de remplir les ingrédients nécessaire à la recette'])
                ]  
            ])
            ->add('ustensiles',TextType::class)
            ->add('user',TextType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}