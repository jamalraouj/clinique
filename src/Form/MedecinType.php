<?php
namespace App\Form;

use App\Entity\Medecin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{TextType,ChoiceType,ButtonType,EmailType,HiddenType,PasswordType,TextareaType,SubmitType,NumberType,DateType,MoneyType,BirthdayType,TimeType,FileType};

class MedecinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matricule',TextType::class,
            ['attr' => ['class' => 'form-control']])
            ->add('experience',TextareaType::class,
            ['attr' => ['class' => 'form-control ExperienceTextera' ,
             'placeholder' => "Veuillez suivre la démarche suivante pour entrez les experiences du docteur : ( Ordre Décroissant )
             A travaillé chez hopital X *!
             A passer un stage chez cabinet Y *!
             
             Note : N'oubliez pas de finir la phrase avec un ( *! )"]])
            ->add('salaire',NumberType::class,
            ['attr' => ['class' => 'form-control' ]])
            ->add('temps_travail',TimeType::class,
            ['attr' => ['class' => 'inputTime']])
            ->add('jour_travail',DateType::class,
            ['attr' => ['class' => 'form-control']])
            ->add('status_medecin',ChoiceType::class,
            [
                'attr' => ['class' => 'form-control'],
                'choices'  => [
                    'Active' => "active",
                    'Inactive' => "inactive",
                    'Malade' => "malade",
                    'En Congé' => "en congé"
                              ],
            ])
            ->add('image_medecin',FileType::class,
            ['attr' => ['class' => 'form-control'] ,
              'data_class' => null ,
              'required' => false
            ])
            ->add('specialite',TextType::class,
            ['attr' => ['class' => 'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Medecin::class,
        ]);
    }
}
