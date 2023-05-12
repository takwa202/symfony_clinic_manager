<?php

namespace App\Form;

use App\Entity\Medecin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedecinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomMed')
            ->add('prenomMed')
            ->add('mdpMed')
            ->add('emailMed')
            ->add('dateNaissanceMed')
            ->add('ageMed')
            ->add('adresseMed')
            ->add('genreMed')
            ->add('numTelMed')
           // ->add('photoMed')
           // ->add('photoDip')
           // ->add('nbRecMed')
           // ->add('nbPatient')
           // ->add('isBlocked')
           // ->add('speciatilte')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Medecin::class,
        ]);
    }
}
