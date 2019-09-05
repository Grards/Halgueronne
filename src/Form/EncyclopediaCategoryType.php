<?php

namespace App\Form;

use App\Entity\EncyclopediaCategories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EncyclopediaCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('cover')
            ->add('orderNumber')
            ->add('visible')
            ->add('slug', HiddenType::class, ['attr'=>['placeholder' => "Will be filled automatically"], 'required'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EncyclopediaCategories::class,
        ]);
    }
}
