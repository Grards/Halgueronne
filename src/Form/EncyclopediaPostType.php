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
use FOS\CKEditorBundle\Form\Type\CKEditorType;

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
            //->add('post', TextareaType::class, $this->getConfiguration("Poste","Entrez un texte ..."))
            ->add( "post", CKEditorType::class,[
                'config' => [
                    // 'uiColor' => '#ffffff',
                    'extraPlugins' => ['wordcount' , 'autogrow', 'youtube', 'filetools', 'lineutils', 'notification', 'balloonpanel', 'balloontoolbar', 'imagebase', 'button', 'xml', 'ajax', 'cloudservices'],
                    // 'toolbar' => 'encyclopedia_toolbar', 
                ],
                'plugins' => [
                    'youtube' => [
                        'path'     => '/bundles/fosckeditor/plugins/youtube/youtube/',
                        'filename' => 'plugin.js',
                    ],
                    'wordcount' => [
                        'path'     => '/bundles/fosckeditor/plugins/wordcount/wordcount/',
                        'filename' => "plugin.js",
                    ],
                    'autogrow' => [
                        'path'     => '/bundles/fosckeditor/plugins/autogrow/',
                        'filename' => "plugin.js",
                    ],
                    'filetools' => [
                        'path'     => '/bundles/fosckeditor/plugins/filetools/',
                        'filename' => "plugin.js",
                    ],
                    'lineutils' => [
                        'path'     => '/bundles/fosckeditor/plugins/lineutils/',
                        'filename' => "plugin.js",
                    ],
                    'notification' => [
                        'path'     => '/bundles/fosckeditor/plugins/notification/',
                        'filename' => "plugin.js",
                    ],
                    'balloonpanel' => [
                        'path'     => '/bundles/fosckeditor/plugins/balloonpanel/',
                        'filename' => "plugin.js",
                    ],
                    'balloontoolbar' => [
                        'path'     => '/bundles/fosckeditor/plugins/balloontoolbar/',
                        'filename' => "plugin.js",
                    ],
                    'imagebase' => [
                        'path'     => '/bundles/fosckeditor/plugins/imagebase/',
                        'filename' => "plugin.js",
                    ],
                    'button' => [
                        'path'     => '/bundles/fosckeditor/plugins/button/',
                        'filename' => "plugin.js",
                    ],
                    'xml' => [
                        'path'     => '/bundles/fosckeditor/plugins/xml/',
                        'filename' => "plugin.js",
                    ],
                    'ajax' => [
                        'path'     => '/bundles/fosckeditor/plugins/ajax/',
                        'filename' => "plugin.js",
                    ],
                    'cloudservices' => [
                        'path'     => '/bundles/fosckeditor/plugins/cloudservices/',
                        'filename' => "plugin.js",
                    ],
                    // 'easyimage' => [
                    //     'path'     => '/bundles/fosckeditor/plugins/easyimage/',
                    //     'filename' => "plugin.js",
                    // ],
                ],
            ])
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
