<?php

namespace App\Form\Admin;

use App\Entity\Character;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ShowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('releasedAt', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'input' => 'datetime_immutable'
            ])
            ->add('trailer', UrlType::class, [
                'required' => false,
            ])
            ->add('synopsis', TextareaType::class, [
                'required' => false,
            ])
            ->add('animation', CheckboxType::class, [
                'required' => false,
            ])
            ->add('duration', IntegerType::class, [
                'required' => false,
            ])
            ->add('chronological', IntegerType::class)
            ->add('logical', IntegerType::class)
            ->add('imageFile', VichImageType::class, [
                'required' => false,
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
            ])
            ->add('characters', EntityType::class, [
                'class' => Character::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
            ])
            ->add('episodes', CollectionType::class, [
                'entry_type' => EpisodeType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
            ])
            ->add('add_episode', ButtonType::class, [
                'label' => 'Add episode',
                'attr' => [
                    'data-collection-holder-id' => 'show_episodes'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Save'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
