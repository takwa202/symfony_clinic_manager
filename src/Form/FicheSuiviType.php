<?php

namespace App\Form;

use App\Entity\Bilan;
use App\Entity\FicheSuivi;
use App\Entity\Patient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class FicheSuiviType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('diagnostic')
            ->add('consigneMedicale')
            ->add('bilan',EntityType::class,[
                'class'=>Bilan::class,'choice_label'=>'type'
            ] )
            ->add('idClient',EntityType::class,[
                'class'=>Patient::class,'choice_label'=>'nomPatient'
            ] )

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FicheSuivi::class,
        ]);
    }
}
