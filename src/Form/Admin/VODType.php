<?php

namespace App\Form\Admin;

use App\Entity\Platform;
use App\Entity\VOD;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VODType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('url', UrlType::class, [
                'label' => 'URL',
                'label_attr' => [
                    'class' => 'label label-text'
                ],
                'attr' => [
                    'class' => 'input input-bordered'
                ],
                'row_attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Abonnement' => 'sub',
                    'Achat' => 'buy',
                    'Location' => 'ren'
                ],
                'label_attr' => [
                    'class' => 'label label-text'
                ],
                'attr' => [
                    'class' => 'select select-bordered'
                ],
                'row_attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('platform', EntityType::class, [
                'class' => Platform::class,
                'choice_label' => 'name',
                'label_attr' => [
                    'class' => 'label label-text'
                ],
                'attr' => [
                    'class' => 'select select-bordered'
                ],
                'row_attr' => [
                    'class' => 'form-control'
                ]
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
