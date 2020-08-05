<?php

namespace App\Form;

use App\Entity\Avis;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,
            [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => "Veuillez entrer un email"
                ]
                
            ])
            ->add('pseudo', TextType::class,
                [
                    'label' => 'Pseudo',
                    'attr' => [
                        'placeholder' => "Veuillez entrer un pseudo"
                    ]

                ])
            ->add('rate',NumberType::class,
                [
                    'label' => 'Note',
                    'attr' => [
                        'placeholder' => "Veuillez entrer une note entre 1 et 5"
                    ]

                ])
            ->add('comment', CKEditorType::class,
                [
                    'label' => 'Commentaire',
                    'attr' => [
                        'placeholder' => "Veuillez entrer un commentaire"
                    ]

                ])
            ->add('picture', FileType::class,
                [
                    'label' => 'Image',
                    'attr' => [
                        'placeholder' => "Veuillez choisir une image"
                    ]

                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}
