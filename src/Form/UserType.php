<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Patient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{TextType,ChoiceType,ButtonType,EmailType,HiddenType,PasswordType,TextareaType,SubmitType,NumberType,DateType,MoneyType,BirthdayType};

use App\Repository\PatientRepository;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    { 
        // $ss = new ManagerRegistry();
        // var_dump(11111111111111111111);exit;
        // $d = new PatientRepository(ManagerRegistry::class);
        // var_dump($d );exit;
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('age')
            ->add('telephone')
            ->add('cin')
            ->add('address')
            ->add('email')
            ->add('password')
            ->add('joindre_a')
            ->add('derniere_conexion')
            ->add('user_role',ChoiceType::class,[
                'attr' => ['class' => 'choicesUsers form-control'],
                'choices'  => [
                    'Super Admin' => 'ROLE_ADMIN' ,
                    'Admin' => 'ROLE_ADMIN',
                    'Patient' => 'ROLE_PATIENT',
                    'Medecin' => 'ROLE_MEDECIN',
                    'Secretaire' => 'ROLE_SECRETARY',
                    'Pharmacien' => 'ROLE_PHARMACIST',
                    'Infirmier' => 'ROLE_NURSE',
                    'AdminResto' => 'ROLE_RESTAURANT_ADMIN',
                    'Autre' => 'ROLE_OTHER'
               ]])
            ->add('mise_a_jour_a')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
