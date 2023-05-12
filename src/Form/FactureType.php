<?php

namespace App\Form;

use App\Entity\Facture;
use App\Entity\Patient;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('quantite')
            ->add('prixTot')
            ->add('prixar')
            ->add('Idprod',EntityType::class,[
                'class'=>Produit::class,'choice_label'=>'nomProd'
            ] )
            ->add('idPatien',EntityType::class,[
                'class'=>Patient::class,'choice_label'=>'nomPatient'
            ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
