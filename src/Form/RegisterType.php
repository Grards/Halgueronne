<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterType extends AbstractType
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
            ->add('login', TextType::class, $this->getConfiguration("","Minimum 3 characters"))
            ->add('password', PasswordType::class, $this->getConfiguration("","Minimum 6 characters"))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration("Password Confirm","Please confirm your password"))
            ->add('mail', EmailType::class, $this->getConfiguration("","Ex : example@mail.com"))
            ->add('avatar', UrlType::class, ['attr'=>['placeholder' => "Ex : http://www.urlavatar.com"], 'required'=>false])
            ->add('role', HiddenType::class, ['attr'=>['placeholder' => "Will be filled automatically"], 'required'=>false])
            ->add('posts', HiddenType::class, ['attr'=>['placeholder' => "Will be filled automatically"], 'required'=>false])
            ->add('slug', HiddenType::class, ['attr'=>['placeholder' => "Will be filled automatically"], 'required'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
