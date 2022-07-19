<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('family_history',null,['attr' => ['class' => 'form-control']])
            ->add('profession',null,['attr' => ['class' => 'form-control']])
            ->add('status_patient',null,['attr' => ['class' => 'form-control']])
            ->add('cree_en',null,['attr' => ['class' => 'form-control']])
            ->add('mise_a_jour_a',null,['attr' => ['class' => 'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
