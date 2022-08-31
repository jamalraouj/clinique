<?php

namespace App\Form;

use App\Entity\Anamnese;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnamneseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('coeur')
            ->add('systeme_pulmonaire')
            ->add('systeme_digestif')
            ->add('systeme_uro_gyneco')
            ->add('systeme_locomoteur')
            ->add('remarques')
            ->add('other')
            ->add('fk_patient')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Anamnese::class,
        ]);
    }
}
