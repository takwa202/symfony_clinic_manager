<?php

namespace App\Form;

use App\Entity\Medecin;
use App\Entity\Patient;
use App\Entity\RendezVous;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RendezVousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateRd',DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'
            ])
            ->add('heureRd',IntegerType::class)
            ->add('idPatient',EntityType::class,[
                'class'=>Patient::class,'choice_label'=>'id_patient'])
            ->add('idMed',EntityType::class,[
                'class'=>Medecin::class,'choice_label'=>'nom_med'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RendezVous::class,
        ]);
    }
}
