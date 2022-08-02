<?php

namespace App\Form;

use App\Entity\Patient;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{TextType,ChoiceType,ButtonType,EmailType,HiddenType,PasswordType,TextareaType,SubmitType,CheckboxType,NumberType,DateType,MoneyType,BirthdayType};

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
      
        
        $builder
            ->add('family_history', TextareaType::class, [
                'label' => 'Family history',
                'attr' => [
                    'name' =>'family_history',
                    'rows' => '7',
                    'placeholder' => 'The history should be detailed, including:

                    First-, 2nd- and 3rd-degree relatives
                    Age for all relatives (age at time of death for the deceased)
                    Ethnicity (some genetic diseases are more common in certain ethnic groups)
                    Presence of chronic diseases',
                    'class' => 'form-control',
                    
                ],
            ],)
            ->add('profession',TextType::class,[
                'label' => "Profession",
                'label_attr' => ['class' => 'your-label-classes', 'for'=>"profession"],
                'attr' => [
                    'name' =>'profession',
                    'placeholder' => 'Profession',
                    'class' => 'form-control',
                    'oninput' => "this.className = ''",],
                'required' => true,])

            ->add('status_patient',ChoiceType::class,[
                'choices'  => [
                    's\'épuiser' => 0,
                    'en cour' => 1,
                    'il a rendez-vous' => 2,
                    'il a quitté' => 3,
                    'il a été hospitalisé' => 4,
                    'il a été défibéré' => 5,
                    'il a été décédé' => 6,
                    'il a été guéri' => 7,
                    'il a été malade' => 8,
                    'il a été malade grave' => 9,
                ],
                'preferred_choices' => [4],
                'label' => "Status",
                'attr' => ['name' =>'status',
                'placeholder' => 'Status',
                'class' => 'form-control',
                'required' => true,],
            ])
            
          
               
                
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patient::class
        ]);
    }
}
