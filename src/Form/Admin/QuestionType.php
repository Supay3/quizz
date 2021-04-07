<?php

namespace App\Form\Admin;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('questionTexte', TextType::class, [
                'label' => 'Votre question'
            ])
            ->add('reponses', CollectionType::class, [
                'entry_type' => ReponseType::class,
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => 'Vos réponses',
                'prototype_name' => '__reponse_prototype__',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
