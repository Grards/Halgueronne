<?php

namespace App\Form;

use App\Entity\Utilisateurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UtilisateursType extends AbstractType
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
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class, $this->getConfiguration("Prénom",""))
            ->add('pseudo', TextType::class)
            ->add('mdp', PasswordType::class, $this->getConfiguration("Mot de passe","Minimum 6 caractères"))
            ->add('email', EmailType::class, $this->getConfiguration("","Ex : exemple@mail.com"))
            ->add('avatar', UrlType::class, $this->getConfiguration("","Ex : http://www.lienimage.com"))
            ->add('rang', TextType::class)
            ->add('naissance', DateType::class, $this->getConfiguration("Date de naissance",""))
            ->add('messages', NumberType::class)
            ->add('slug', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }
}
