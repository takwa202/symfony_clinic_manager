<?php

namespace App\Form;

use App\Entity\Symptome;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SymptomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fievre',ChoiceType::class ,array(
                'choices' =>array(
                    'Oui' => true,
                    'Non'=> false
                ),
                'multiple'=>false,
                'expanded'=>true
            ))
            ->add('toux',ChoiceType::class ,array(
                'choices' =>array(
                    'Oui' => true,
                    'Non'=> false
                ),
                'multiple'=>false,
                'expanded'=>true
            ))
            ->add('fatigue',ChoiceType::class ,array(
                'choices' =>array(
                    'Oui' => true,
                    'Non'=> false
                ),
                'multiple'=>false,
                'expanded'=>true
            ))
            ->add('douleurMusculaire',ChoiceType::class ,array(
                'choices' =>array(
                    'Oui' => true,
                    'Non'=> false
                ),
                'multiple'=>false,
                'expanded'=>true
            ))
            ->add('malDeGorge',ChoiceType::class ,array(
                'choices' =>array(
                    'Oui' => true,
                    'Non'=> false
                ),
                'multiple'=>false,
                'expanded'=>true
            ))
            ->add('essouflement',ChoiceType::class ,array(
                'choices' =>array(
                    'Oui' => true,
                    'Non'=> false
                ),
                'multiple'=>false,
                'expanded'=>true
            ))
            ->add('perteDAppetit',ChoiceType::class ,array(
                'choices' =>array(
                    'Oui' => true,
                    'Non'=> false
                ),
                'multiple'=>false,
                'expanded'=>true
            ))
            ->add('ecoulementNasal',ChoiceType::class ,array(
                'choices' =>array(
                    'Oui' => true,
                    'Non'=> false
                ),
                'multiple'=>false,
                'expanded'=>true
            ))
            ->add('nausee',ChoiceType::class ,array(
                'choices' =>array(
                    'Oui' => true,
                    'Non'=> false
                ),
                'multiple'=>false,
                'expanded'=>true
            ))
            ->add('vomissement',ChoiceType::class ,array(
                'choices' =>array(
                    'Oui' => true,
                    'Non'=> false
                ),
                'multiple'=>false,
                'expanded'=>true
            ))
            ->add('malDeTete',ChoiceType::class ,array(
                'choices' =>array(
                    'Oui' => true,
                    'Non'=> false
                ),
                'multiple'=>false,
                'expanded'=>true
            ))
            ->add('autre',TextareaType::class,
                ['required'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Symptome::class,
        ]);
    }
}
