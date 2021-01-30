<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Departement;
use App\Entity\Professeur;
/*
use Doctrine\DBAL\Types\TextType;
*/
use Symfony\Component\Form\Extension\Core\Type\TextType;


use phpDocumentor\Reflection\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfesseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('cin',TextType::class)
            ->add('adresse',TextType::class)
            ->add('telephone',NumberType::class)
            ->add('email',EmailType::class)
            ->add('date_recrutement',DateType::class)
            ->add('departement',EntityType::class, ['class'=>Departement::class, 'choice_label'=>'nom_depart'])
            ->add('cours',EntityType::class, ['class'=>Cours::class, 'choice_label'=>'intitule',
                'multiple'=>true,
                'expanded'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Professeur::class,
        ]);
    }
}
