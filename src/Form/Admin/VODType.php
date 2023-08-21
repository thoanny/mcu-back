<?php

namespace App\Form\Admin;

use App\Entity\Platform;
use App\Entity\VOD;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VODType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('url')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Abonnement' => 'sub',
                    'Achat' => 'buy',
                    'Location' => 'ren'
                ]
            ])
            ->add('platform', EntityType::class, [
                'class' => Platform::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VOD::class,
        ]);
    }
}
