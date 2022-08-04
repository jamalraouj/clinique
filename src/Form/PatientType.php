<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{TextType,ChoiceType,ButtonType,EmailType,HiddenType,PasswordType,TextareaType,SubmitType,NumberType,DateType,MoneyType,BirthdayType};

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('family_history',TextareaType::class,['attr' => ['class' => 'form-control' ]])
            
            ->add('profession',TextType::class,[
                'label' => "Profession",
                'label_attr' => ['class' => 'your-label-classes', 'for'=>"profession"],
                'attr' => ['class' => 'form-control'],
                'required' => true,])

            ->add('status_patient',ChoiceType::class,[
                'choices'  => [
                    's\'épuiser' => null,
                    'en cour' => true,
                    'il a rendez-vous' => false,
                ],
                'label' => "Status",
                'attr' => ['class' => 'form-control'],
                'required' => true])
                
            ->add('cree_en',DateType::class,['attr' => ['class' => 'form-control']])
            ->add('mise_a_jour_a',null,['attr' => ['class' => 'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
