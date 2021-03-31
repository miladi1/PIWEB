<?php

namespace App\Form;
use App\Entity\opportunite;
 
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
 
use App\Entity\Candidature;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class CandidatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
             
           


            ->add('titre', EntityType::class,array (
                'class' => opportunite::class,
                
                'choice_label' => 'titre',
                
            ))
            
                ->add('fonction', ChoiceType::class,array (
                    'choices' => array(
                    'Selectionner.....' => 1,
                    'Développeur web' =>  'Développeur web' ,
                    'Ingenieur réseaux' => 'Ingenieur réseaux',
                    'Agent Agriculteur' =>  'Agent Agriculteur' ,

                    )
                )   )
                ->add('type_contrat', ChoiceType::class,array (
                    'choices' => array(
                    'Selectionner.....' => 1,
                    'CDD' =>  'CDD' ,
                    'CDI' => 'CDI',
                    'Stage' => 'Stage' ,
                                    )
                )   )
                ->add('horaires', ChoiceType::class,array (
                    'choices' => array(
                    'Selectionner.....' => 1,
                    'Temps plein' =>  'Temps plein' ,
                    'Temps partiel' => 'Temps partiel',
                    'Fin de semaine' =>  'Fin de semaine' ,
                    
                    )
                )   )
            
               
                ->add('mode_salaire', ChoiceType::class,array (
                    'choices' => array(
                    'Selectionner.....' => 1,
                    'suivant profil' =>  'suivant profil' ,
                    'fixe' => 'fixe',
                    
                    )
                )   )
                ->add('periode', ChoiceType::class,array (
                    'choices' => array(
                    'Selectionner.....' => 1,
                    'Annuel' =>'Annuel' ,
                    'Mois' =>'Mois',
                    
                    )
                )   )
                ->add('annuel_mois')
                
                
             
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidature::class,
        ]);
    }
}
