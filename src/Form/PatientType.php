<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomPatient')
            ->add('prenomPatient')
            ->add('emailPatient')
            ->add('adressPatient')
            ->add('numtelPatient')
            ->add('motdepasselPatient')
            ->add('agePatient')
            ->add('gendrePatient', ChoiceType::class, [
                'choices'  => [
                    'FEMALE' =>  'FEMALE',
                    'MALE' => 'MALE',
                ],
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
