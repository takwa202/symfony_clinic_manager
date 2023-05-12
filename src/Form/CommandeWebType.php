<?php

namespace App\Form;

use App\Entity\CommandeWeb;
use App\Entity\Produit;
use App\Entity\Patient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Gregwar\CaptchaBundle\Type\CaptchaType;

class CommandeWebType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite')
            ->add('destination')
            ->add('dateComd')
            ->add('idProduit',EntityType::class,[
                'class'=>Produit::class,'choice_label'=>'nomProd'
            ] )
            ->add('idPatien',EntityType::class,[
                'class'=>Patient::class,'choice_label'=>'nomPatient'
            ] )
            ->add('captcha', CaptchaType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CommandeWeb::class,
        ]);
    }
}
