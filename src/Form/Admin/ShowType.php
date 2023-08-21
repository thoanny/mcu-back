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
            ->add('title', TextType::class, [
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
            ->add('releasedAt', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
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
            ->add('trailer', UrlType::class, [
                'required' => false,
                'label' => 'Trailer URL',
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
            ->add('synopsis', TextareaType::class, [
                'required' => false,
                'label_attr' => [
                    'class' => 'label label-text'
                ],
                'attr' => [
                    'class' => 'textarea textarea-bordered'
                ],
                'row_attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('animation', CheckboxType::class, [
                'required' => false,
                'label' => 'Animation',
                'label_attr' => [
                    'class' => 'label label-text'
                ],
                'attr' => [
                    'class' => 'toggle toggle-primary'
                ],
                'row_attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('duration', IntegerType::class, [
                'required' => false,
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
            ->add('chronological', IntegerType::class, [
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
            ->add('logical', IntegerType::class, [
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
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'label' => 'Thumbnail',
                'label_attr' => [
                    'class' => 'label label-text'
                ],
                'attr' => [
                    'class' => 'file-input file-input-bordered w-full'
                ],
                'row_attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('characters', EntityType::class, [
                'class' => Character::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'label_attr' => [
                    'class' => 'text-xl font-semibold'
                ],
                'row_attr' => [
                    'class' => 'form-control mt-4'
                ],
            ])
            ->add('episodes', CollectionType::class, [
                'entry_type' => EpisodeType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'label_attr' => [
                    'class' => 'text-xl font-semibold'
                ],
                'row_attr' => [
                    'class' => 'form-control mt-4'
                ],
            ])
            ->add('add_episode', ButtonType::class, [
                'label' => 'Add episode',
                'attr' => [
                    'data-collection-holder-id' => 'show_episodes',
                    'class' => 'btn btn-primary btn-sm mt-2'
                ]
            ])
            ->add('vods', CollectionType::class, [
                'entry_type' => VODType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'label_attr' => [
                    'class' => 'text-xl font-semibold'
                ],
                'row_attr' => [
                    'class' => 'form-control mt-4'
                ],
                'label' => 'VOD'
            ])
            ->add('add_vod', ButtonType::class, [
                'label' => 'Add VOD',
                'attr' => [
                    'data-collection-holder-id' => 'show_vods',
                    'class' => 'btn btn-primary btn-sm mt-2'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Save show',
                'attr' => [
                    'class' => 'btn btn-primary'
                ],
                'row_attr' => [
                    'class' => 'form-control mt-4'
                ],
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
