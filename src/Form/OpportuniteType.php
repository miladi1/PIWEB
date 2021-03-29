<?php

namespace App\Form;
use App\Entity\employeur;
use App\Entity\opportunite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpKernel\KernelInterface;

class OpportuniteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('logo',FileType::class, array('data_class' => null))
            ->add('titre', ChoiceType::class,array (
                'choices' => array(
                'Selectionner.....' => 1,
                'Agriculture' =>  'Agriculture' ,
                'Informatique' => 'Informatique',
                 
                )
            )   )
            ->add('lieu')
            ->add('description')
           
            ->add('nom_entreprise')
             
            
             
            ->add('nombre_recrutement')
            
            ->add('taille_entreprise', ChoiceType::class,array (
                'choices' => array(
                'Selectionner.....' => 1,
                '1-49' => '1-49',
                '50-99' => '50-99',
                'superieur à 100' => 'superieur à 100',

                )
            )   )
            ->add('media', ChoiceType::class,array (
                'choices' => array(
                'Selectionner.....' => 1,
                'journale' =>  'journale' ,
                'affiche pub' => 'affiche pub',

                )
            )   )
            ->add('poste', ChoiceType::class,array (
                'choices' => array(
                'Selectionner.......' => 1,
                'Employeur' => 'Employeur',
                'Agence de recrutement' => 'Agence de recrutement',
               
                )
                
            )   
             

            )
             
            ->add('opEmployeur', EntityType::class, [
                    'class' => employeur::class,
                    
                    'choice_label' => 'nom',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => opportunite::class,
        ]);
    }
}
