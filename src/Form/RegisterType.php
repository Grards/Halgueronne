<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TimezoneType;

class RegisterType extends AbstractType
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
            ->add('login', TextType::class, $this->getConfiguration("Login","Minimum 3 caractères"))
            ->add('password', PasswordType::class, $this->getConfiguration("Mot de passe","Minimum 6 caractères"))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration("Confirmation","Veuillez confirmer votre mot de passe"))
            ->add('mail', EmailType::class, $this->getConfiguration("Email","Ex : exemple@mail.com"))
            ->add('avatar', UrlType::class, ['attr'=>['placeholder' => "Ex : http://www.urlavatar.com"], 'required'=>false])
            ->add('timeZone', TimezoneType::class, $this->getConfiguration("Fuseau horaire","Veuillez sélectionner votre fuseau horaire") )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
