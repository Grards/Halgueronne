<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('Fr-fr');
        

        // for($i=1; $i<=30; $i++){
        //     $badge = new Badges();

        //     $titre = $faker->sentence($nbWords = 6, $variableNbWords = true);
        //     $description = $faker->paragraphs($nb = 3, $asText = false);
        //     $image = $faker->imageUrl(150,150);

        //     $badge->setTitre($titre)
        //           ->setDescription($description)
        //           ->setImage($image)
        //           ->setSlug($slug);

        //     $manager->persist($badge);
        // }

        for($i=1; $i<=10; $i++){
            $users = new Users();
            
            /* On donne le mot de passe 'password' par défaut aux Fakers, qui sont ensuite cryptés dans la BDD, en guise de test */
            $hash = $this->encoder->encodePassword($users, 'password');

            $login = $faker->userName();
            $mail = $faker->freeEmail();
            $avatar = $faker->imageUrl(200,200);
            $role = $faker->jobTitle();

            $users->setLogin($login)
                        ->setPassword($hash)
                        ->setMail($mail)
                        ->setAvatar($avatar)
                        ->setRole($role)
                        ->setPosts(mt_rand(0,120));

            $manager->persist($users);
        }


        
        $manager->flush();           
    }
}
