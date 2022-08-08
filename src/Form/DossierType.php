<?php

namespace App\Form;


use App\Entity\Dossier;
use App\Entity\Specialite;
use App\Entity\Medecin;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{TextType,ChoiceType,ButtonType,EmailType,HiddenType,PasswordType,TextareaType,SubmitType,CheckboxType,NumberType,DateType,MoneyType,BirthdayType};
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class DossierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('cahier_sante')
            ->add('prix')
            ->add('prix_avance')
            ->add('prix_restant')
            ->add('status_dossier')
            ->add('fk_specialite', EntityType::class, [
                'class' => Specialite::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false,
                
            ])
            
            ->add('fk_medecin', EntityType::class, [
                'class' => Medecin::class,
                'choice_label' =>  function ($nomcentral) {
                    
                  return $nomcentral->getUser()->getNom() . ' ' . $nomcentral->getUser()->getPrenom() . ' | ' . $nomcentral->getSpecialite();
                } ,
               
                'multiple' => true,
                'expanded' => true,
                'label' => "Medecin",
                'attr' => ['name' =>'medecin',
                'required' => true,],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dossier::class,
        ]);
    }
}
