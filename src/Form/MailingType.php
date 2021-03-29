<?php

namespace App\Form;
use App\Entity\candidature;
use App\Entity\employer;
use App\Entity\Mailing;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
class MailingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sujet')
            ->add('email', EmailType::class, array('attr' => array('placeholder' => 'Your email address'),
            'constraints' => array(
                new NotBlank(array("message" => "Please provide a valid email")),
                new Email(array("message" => "Your email doesn't seems to be valid")),
            )
        ))
        ->add('ref',  HiddenType::class, [
            'required'   => false,
            
             
        ])
            
            ->add('etat',  HiddenType::class, [
                'required'   => false,
                'empty_data' => 'Verifier Demande',
                 
            ])
                
                
            
            ->add('numero', EntityType::class, [
                  'class' => employer::class,
                
                'choice_label' => 'num',
            ])
            
          
             
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mailing::class,
        ]);
    }
}
