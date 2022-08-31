<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Patient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{TextType,ChoiceType,ButtonType,EmailType,HiddenType,PasswordType,TextareaType,SubmitType,NumberType,DateType,MoneyType,BirthdayType};

use App\Repository\PatientRepository;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    { 
    
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'name' =>'fname',
                    'placeholder' => 'Nom',
                    'class' => 'form-control',
                    'oninput' => "this.className = ''",
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prenom',
                'attr' => [
                    'name' =>'lname',
                    'placeholder' => 'Prenom',
                    'class' => 'form-control',
                    'oninput' => "this.className = ''",
                ],
            ])
            ->add('age', NumberType::class, [
                'label' => 'Age',
                'attr' => [
                    'name' =>'age',
                    'placeholder' => 'Age',
                    'class' => 'form-control',
                    'oninput' => "this.className = ''",
                ],
            ])
            ->add('sexe', ChoiceType::class, [
                'label' => 'Sexe',
                'attr' => [
                    'class' => 'form-control',
                    'name' =>'sexe',
                ],
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                ],
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'name' =>'telephone',
                    'placeholder' => '+212 658 987 6543',
                    'class' => 'form-control',
                    'oninput' => "this.className = ''",
                ],
            ])
            ->add('cin', TextType::class, [
                'label' => 'CIN',
                'attr' => [
                    'name' =>'cin',
                    'placeholder' => 'QQ246345',
                    'class' => 'form-control',
                    'oninput' => "this.className = ''",
                ],
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse',
                'attr' => [
                    'name' =>'adresse',
                    'placeholder' => '1610 Main Street',
                    'class' => 'form-control',
                    'oninput' => "this.className = ''",
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'name' =>'email',
                    'placeholder' => 'example@mail.com',
                    'class' => 'form-control',
                    'oninput' => "this.className = ''",
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => [
                    'name' =>'password',
                    'placeholder' => 'Plus de 6 lettres et chiffres',
                    'class' => 'form-control',
                    'oninput' => "this.className = ''",
                ],
            ])
            ->add('user_role',ChoiceType::class,[
                'attr' => ['class' => 'choicesUsers form-control'],
                'choices'  => [
                    'Super Admin' => 'ROLE_SUPER_ADMIN' ,
                    'Admin' => 'ROLE_ADMIN',
                    'Patient' => 'ROLE_PATIENT',
                    'Medecin' => 'ROLE_MEDECIN',
                    'Secretaire' => 'ROLE_SECRETARY',
                    'Pharmacien' => 'ROLE_PHARMACIST',
                    'Infirmier' => 'ROLE_NURSE',
                    'AdminResto' => 'ROLE_RESTAURANT_ADMIN',
                    'Autre' => 'ROLE_OTHER'
               ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}