<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Users;
use App\Entity\Characters;
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

        $user_array=[]; /* pour ajouter des users à nos annonces automatiquement */

        $adminUser = new Users();
        $adminUser->setLogin('Lucifer_Kira')
                    ->setPassword($this->encoder->encodePassword($adminUser, 'password'))
                    ->setMail('grard.steve@gmail.com')
                    ->setAvatar('https://scontent.fbru3-1.fna.fbcdn.net/v/t1.0-9/603272_10200266750574760_1373709910_n.jpg?_nc_cat=104&_nc_ht=scontent.fbru3-1.fna&oh=7079e66182ae62834cf3fd69ec23a72b&oe=5DBABDF0')
                    ->setRole('ROLE_ADMIN')
                    ->setPosts(0);
        
        $manager->persist($adminUser);   

        for($i=1; $i<=10; $i++){
            
            $users = new Users();

            /* On donne le mot de passe 'password' par défaut aux Fakers, qui sont ensuite cryptés dans la BDD, en guise de test */
            $hash = $this->encoder->encodePassword($users, 'password');
            
            $login = $faker->userName();
            $mail = $faker->freeEmail();
            $avatar = $faker->imageUrl(200,200);

            $users->setLogin($login)
                    ->setPassword($hash)
                    ->setMail($mail)
                    ->setAvatar($avatar)
                    ->setRole('ROLE_USER')
                    ->setPosts(mt_rand(0,120));

            $manager->persist($users);
            $user_array[] = $users; /* pour remplir le tableau  */
        }

        for($i=1; $i<=10; $i++){
            
            $characters = new Characters();
            
            $lastname = $faker->lastName();
            $firstname = $faker->firstName();
            $gender = $faker->randomElement($array = array ('m','f'));
            $picture = $faker->imageUrl(200,400);
            $background = $faker->text($maxNbChars = 600);
            $user = $user_array[mt_rand(0,count($user_array)-1)]; /* pour choisir un user du tableau entre 0 et 10 (11 entrées, Admin compris, - 1) - automatique avec count */

            $characters->setLastname($lastname)
                    ->setFirstname($firstname)
                    ->setGender($gender)
                    ->setPicture($avatar)
                    ->setBirthDay(mt_rand(1,30))
                    ->setBirthMonth(mt_rand(1,12))
                    ->setBirthYear(mt_rand(-2000,3000))
                    ->setBackground($background)
                    ->setUser($user);

            $manager->persist($characters);
        }


        // $badge_array=[]; /* pour ajouter des users à nos annonces automatiquement */
        // for($i=1; $i<=30; $i++){
        //     $badges = new Badges();

        //     $title = $faker->sentence($nbWords = 2, $variableNbWords = true);
        //     $description = $faker->text($maxNbChars = 200);
        //     $picture = $faker->imageUrl(150,150);

        //     $badges->setTitle($title)
        //           ->setDescription($description)
        //           ->setPicture($picture);

        //     $manager->persist($badges);
        //     $badge_array[] = $badges; /* pour remplir le tableau  */
        // }

        // for($i=1; $i<=60; $i++){
        //     $badges_users = New BadgesObtained();

        //     $date_obtained = $faker->dateTimeAD($max = 'now', $timezone = null); // DateTime('1800-04-29 20:38:49', 'Europe/Paris')
        //     $badge = $badge_array[mt_rand(0,count($badge_array)-1)]; /* pour choisir un user du tableau entre 0 et 29 (30 entrées - 1) - automatique avec count */
        //     $user_badge = $user_array[mt_rand(0,count($user_array)-1)]; /* pour choisir un user du tableau entre 0 et 9 (10 entrées - 1) - automatique avec count */

        //     $badges_users->setDateObtained($date_obtained)
        //                ->setBadge($badge)
        //                ->setUser($user_badge);

        //     $manager->persist($badges_users);
        // }

        
        $manager->flush();           
    }
}
