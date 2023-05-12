<?php

namespace App\Form;

use App\Entity\Pharmacien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PharmacienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomPharmacien')
            ->add('prenomPharmacien')
            ->add('adressPharmacien')
            ->add('numtelPharmacien')
            ->add('motdepassePharmacien')
            ->add('emailPharmacien')
            ->add('blockfarm')
            ->add('picturepharm')
            ->add('nbrreclamation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pharmacien::class,
        ]);
    }
}
