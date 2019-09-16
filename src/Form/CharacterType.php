<?php

namespace App\Form;

use App\Entity\Races;
use App\Entity\Skills;
use App\Entity\Classes;
use App\Entity\Characters;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CharacterType extends AbstractType
{
    /**
     * Permet d'avoir la configraution de base d'un champ
     *
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     */
    protected function getConfiguration($label, $placeholder, $options = [] ){
        return array_merge_recursive([
                'label' => $label,
                'attr' => [
                    'placeholder' => $placeholder
                ]
                ],$options);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $gender = ['Masculin' => 'm','Féminin' => 'f'];

        $builder
            ->add('lastname', TextType::class, $this->getConfiguration("Nom","Choisissez un nom de famille pour votre personnage..."))
            ->add('firstname', TextType::class, $this->getConfiguration("Prénom","Choisissez un prénom pour votre personnage..."))
            ->add('gender', ChoiceType::class, [
                'choices'  => $gender,
                'multiple' => false,
                'expanded' => true,
                'label' => 'Genre'
            ])
            ->add('picture', UrlType::class, $this->getConfiguration("Image","Choisissez une image représentant votre personnage..."))
            ->add('birthDay', IntegerType::class, $this->getConfiguration("Jour","1-31", [
                'attr' => [
                    'min' => 1,
                    'max' => 31,
                    'step' => 1
                ]
            ]))
            ->add('birthMonth', IntegerType::class, $this->getConfiguration("Mois","1-12", [
                'attr' => [
                    'min' => 1,
                    'max' => 12,
                    'step' => 1
                ]
            ]))
            ->add('birthYear', IntegerType::class, $this->getConfiguration("Année","1100-1120",[
                'attr' => [
                    'min' => 1100,
                    'max' => 1120,
                    'step' => 1
                ]
            ]))
            ->add('background', TextareaType::class, $this->getConfiguration("Biographie","Ecrivez le passé de votre personnage jusqu'à son arrivée en jeu..."))
            ->add('races', EntityType::class,[
                'placeholder' => 'Choisissez votre race',
                'class' => Races::class,
                'choice_label' => function($races){
                    return $races->getTitle();
                },
                'label' => 'Race'
            ])
            ->add('classes', EntityType::class,[
                'placeholder' => 'Choisissez votre classe',
                'class' => Classes::class,
                'choice_label' => function($classes){
                    return $classes->getTitle();
                },
                'label' => 'Classe'
            ])
            ->add('skills', EntityType::class,[
                'placeholder' => 'Choisissez vos compétences',
                'class' => Skills::class,
                'choice_label' => function($skills){
                    return $skills->getTitle()." : ".$skills->getDescription();
                },
                'label' => 'Compétences',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Characters::class,
        ]);
    }
}
