<?php

namespace App\Form;

use App\Entity\Intervention;
use App\Entity\Patient;
use Proxies\__CG__\App\Entity\Medecin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class InterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descriptions')
            ->add('start',DateTimeType::class,[
                'date_widget'=>'single_text'
            ])
            ->add('end',DateTimeType::class,[
                'date_widget'=>'single_text'
            ])
            ->add('backgroundcolor',ColorType::class)
            ->add('bordercolor',ColorType::class)
            ->add('textcolor',ColorType::class)
            ->add('idMed',EntityType::class,[
                'class'=>Medecin::class,'choice_label'=>'nomMed'
              ] )
            ->add('idPatien',EntityType::class,[
                'class'=>Patient::class,'choice_label'=>'nomPatient'
              ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intervention::class,
        ]);
    }
}
