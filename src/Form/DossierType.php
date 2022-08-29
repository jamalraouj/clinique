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
            ->add('status_dossier',ChoiceType::class,[
                'choices'=>[
                    'En cours'=>'0',
                    'En attente'=>'1',
                    'Terminé'=>'2',
                    'Annulé'=>'3',

                ],
                'label'=>'Status du dossier'

            ])
            ->add('fk_specialite', EntityType::class, [
                'class' => Specialite::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false,
                'label'=>'A quelle spécialisation appartient ce dossier ? ',
                'attr' => [
                    'name' =>'specialite',
                    'placeholder' => 'Specialite',
                    'class' => 'form-control',
                ],
                'required' => true
            ])
            
            ->add('fk_medecin', EntityType::class, [
                'class' => Medecin::class,

                'choice_label' =>  function ($nomcentral){
                    // var_dump( $nomcentral->getFkSpecialite()->getNom());exit;
                    $specialite = '';
                    $specialiteOBJ = $nomcentral->getFkSpecialite();
                    foreach ($specialiteOBJ as $value){
                       $specialite .=  $value->getNom() .' ,';
                    }
                  return $nomcentral->getUser()->getNom() . '|' . $nomcentral->getUser()->getPrenom() .'|' . $nomcentral->getImageMedecin() .'|' . $nomcentral->getStatusMedecin().'|' . $specialite ;
                } ,
               
                'multiple' => true,
                'expanded' => true,
                'label' => "Medecins :" ,
                'label_attr' => ['id' => 'MedecinInfoLabel'],
                'attr' => ['name' =>'medecin',
                'placeholder' => 'Medecin',
                'class' => 'd-flex flex-column flex-md-row align-items-center'],
                'required' => true
                ])
            ->add('save',SubmitType::class,[
                'label' =>'Créer',

                'attr' => [
                    'class' => 'btn btn-primary',
                    'style' => 'margin-top:20px;',

                ],

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
