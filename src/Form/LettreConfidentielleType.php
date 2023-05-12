<?php

namespace App\Form;

use App\Entity\LettreConfidentielle;
use App\Entity\Ordonnance;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LettreConfidentielleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('description')
            ->add('signature')
            ->add('idOrdonnance',EntityType::class,['class'=>Ordonnance::class,'choice_label'=>'idOrdonnance'])

        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LettreConfidentielle::class,
        ]);
    }
}
