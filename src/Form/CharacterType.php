<?php

namespace App\Form;

use App\Entity\Characters;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class CharacterType extends AbstractType
{
    /**
     * Permet d'avoir la configuration de base d'un champ
     * 
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder){
        return[
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('gender')
            ->add('picture')
            ->add('birthDay')
            ->add('birthMonth')
            ->add('birthYear')
            ->add('deathDay')
            ->add('deathMonth')
            ->add('deathYear')
            ->add('background')
            ->add('slug', HiddenType::class, ['attr'=>['placeholder' => "Will be filled automatically"], 'required'=>false])
            ->add('user', HiddenType::class, ['attr'=>['placeholder' => "Will be filled automatically"], 'required'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Characters::class,
        ]);
    }
}
