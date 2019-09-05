<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\EncyclopediaPosts;
use App\Entity\EncyclopediaTopics;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EncyclopediaPostType extends AbstractType
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
        $builder
            ->add('title', TextType::class, $this->getConfiguration("Titre","Encodez un titre pour votre poste"))
            ->add('post', TextareaType::class, $this->getConfiguration("Poste","Entrez un texte ..."))
            ->add('encyclopediaTopic', EntityType::class,[
                'placeholder' => 'Choisissez un topic qui contiendra votre poste',
                'class' => EncyclopediaTopics::class,
                'choice_label' => function($topics){
                    return $topics->getTitle();
                },
                'label' => 'Topic'
            ])                     
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EncyclopediaPosts::class,
        ]);
    }
}
