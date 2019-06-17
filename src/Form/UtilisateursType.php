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
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
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
            ->add('pseudo', TextType::class)
            ->add('mdp', PasswordType::class, $this->getConfiguration("Mot de passe","Minimum 6 caractères"))
            ->add('email', EmailType::class, $this->getConfiguration("","Ex : exemple@mail.com"))
            ->add('avatar', UrlType::class, ['attr'=>['placeholder' => "Ex : http://www.lienimage.com"], 'required'=>false])
            ->add('rang', TextType::class)
            ->add('messages', HiddenType::class, ['data' => 0])
            ->add('slug', HiddenType::class, ['data' => 'valeurpardefaut'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }
}
