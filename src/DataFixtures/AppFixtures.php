<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Races;
use App\Entity\Users;
use App\Entity\Skills;
use App\Entity\Spells;
use App\Entity\Classes;
use App\Entity\Injuries;
use App\Entity\Characters;
use App\Entity\EncyclopediaPosts;
use App\Entity\EncyclopediaTopics;
use App\Entity\EncyclopediaCategories;
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
        $race_array=[];
        $classe_array=[];
        $injury_array=[];
        $skill_array=[];
        $spell_array=[];

        $adminUser = new Users();
        $adminUser->setLogin('Lucifer_Kira')
                    ->setPassword($this->encoder->encodePassword($adminUser, 'password'))
                    ->setMail('grard.steve@gmail.com')
                    ->setAvatar('https://scontent.fbru3-1.fna.fbcdn.net/v/t1.0-9/603272_10200266750574760_1373709910_n.jpg?_nc_cat=104&_nc_ht=scontent.fbru3-1.fna&oh=7079e66182ae62834cf3fd69ec23a72b&oe=5DBABDF0')
                    ->setRole('ROLE_ADMIN')
                    ->setPosts(0);
        
        $manager->persist($adminUser);  
        $user_array[] = $adminUser; /* pour remplir le tableau  */ 

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

            $races = new Races();

            $title = $faker->sentence($nbWords = 2, $variableNbWords = true);
            $description = $faker->text($maxNbChars = 200);
            $picture = $faker->imageUrl(200,400);

            $races->setTitle($title)
                  ->setDescription($description)
                  ->setPicture($picture);
                  
            $manager->persist($races);
            $race_array[] = $races; /* pour remplir le tableau  */ 
        }

        for($i=1; $i<=10; $i++){

            $classes = new Classes();

            $title = $faker->sentence($nbWords = 2, $variableNbWords = true);
            $description = $faker->text($maxNbChars = 200);
            $picture = $faker->imageUrl(200,400);

            $classes->setTitle($title)
                    ->setDescription($description)
                    ->setPicture($picture);
                  
            $manager->persist($classes);
            $classe_array[] = $classes; /* pour remplir le tableau  */ 
        }

        for($i=1; $i<=20; $i++){

            $injuries = new Injuries();

            $title = $faker->sentence($nbWords = 2, $variableNbWords = true);
            $description = $faker->text($maxNbChars = 200);
            $picture = $faker->imageUrl(200,400);

            $injuries->setTitle($title)
                    ->setDescription($description)
                    ->setPicture($picture);
                  
            $manager->persist($injuries);
            $injury_array[] = $injuries; /* pour remplir le tableau  */ 
        }

        for($i=1; $i<=20; $i++){

            $skills = new Skills();

            $title = $faker->sentence($nbWords = 2, $variableNbWords = true);
            $description = $faker->text($maxNbChars = 200);
            $picture = $faker->imageUrl(200,400);

            $skills->setTitle($title)
                    ->setDescription($description)
                    ->setPicture($picture);
                  
            $manager->persist($skills);
            $skill_array[] = $skills; /* pour remplir le tableau  */ 
        }

        for($i=1; $i<=20; $i++){

            $spells = new Spells();

            $title = $faker->sentence($nbWords = 2, $variableNbWords = true);
            $description = $faker->text($maxNbChars = 200);
            $picture = $faker->imageUrl(200,400);

            $spells->setTitle($title)
                    ->setDescription($description)
                    ->setPicture($picture);
                  
            $manager->persist($spells);
            $spell_array[] = $spells; /* pour remplir le tableau  */ 
        }

        for($i=1; $i<=50; $i++){
            
            $characters = new Characters();
            
            $lastname = $faker->lastName();
            $firstname = $faker->firstName();
            $gender = $faker->randomElement($array = array ('m','f'));
            $picture = $faker->imageUrl(200,300);
            $background = $faker->text($maxNbChars = 600);
            $user = $user_array[mt_rand(0,count($user_array)-1)]; /* pour choisir un user du tableau entre 0 et 10 (11 entrées, Admin compris, - 1) - automatique avec count */
            $race = $race_array[mt_rand(0,count($race_array)-1)];
            $classe = $classe_array[mt_rand(0,count($classe_array)-1)];
            for($j=1; $j<= mt_rand(0, 4); $j++){
                $injuries = $injury_array[mt_rand(0,count($injury_array)-1)];
                $characters->addInjury($injuries);
            }
            for($j=1; $j<= mt_rand(3, 9); $j++){
                $skills = $skill_array[mt_rand(0,count($skill_array)-1)];
                $characters->addSkill($skills);
            }
            for($j=1; $j<= mt_rand(0, 4); $j++){
                $spells = $spell_array[mt_rand(0,count($spell_array)-1)];
                $characters->addSpell($spells);
            }

            $characters->setLastname($lastname)
                    ->setFirstname($firstname)
                    ->setGender($gender)
                    ->setPicture($picture)
                    ->setBirthDay(mt_rand(1,30))
                    ->setBirthMonth(mt_rand(1,12))
                    ->setBirthYear(mt_rand(-2000,3000))
                    ->setBackground($background)
                    ->setUser($user)
                    ->setRaces($race)
                    ->setClasses($classe);

            $manager->persist($characters);
        }

        for($i=1; $i<=10; $i++){
            $encyclopedia_categories = new EncyclopediaCategories();

            $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
            $description = $faker->paragraph($nbSentences = 3, $variableNbSentences = true);
            $cover = $faker->imageUrl($width = 400, $height = 200);

            $encyclopedia_categories->setTitle($title)
                                    ->setDescription($description)
                                    ->setCover($cover)
                                    ->setOrderNumber($i)
                                    ->setVisible(mt_rand(0,1));

            for($j=1; $j<=10; $j++){
                $encyclopedia_topics = new EncyclopediaTopics();

                $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
                $description = $faker->paragraph($nbSentences = 3, $variableNbSentences = true);
                
                $encyclopedia_topics->setTitle($title)
                                    ->setDescription($description)
                                    ->setOrderNumber($j)
                                    ->setVisible(mt_rand(0,1))
                                    ->setEncyclopediaCategory($encyclopedia_categories);

                for($k=1; $k<=10; $k++){
                    $encyclopedia_posts = new EncyclopediaPosts();

                    $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
                    $user = $user_array[mt_rand(0,count($user_array)-1)]; /* pour choisir un user du tableau entre 0 et 10 (11 entrées, Admin compris, - 1) - automatique avec count */
                    $date = $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null);
                    $post = $faker->text($maxNbChars = 2000);

                    $encyclopedia_posts->setTitle($title)
                                       ->setPost($post)
                                       ->setCreationDate($date)
                                       ->setUpdateDate($date)
                                       ->setVisible(mt_rand(0,1))
                                       ->setEncyclopediaTopic($encyclopedia_topics)
                                       ->setAuthor($user);

                    $manager->persist($encyclopedia_posts);
                }

                $manager->persist($encyclopedia_topics);
            }

            $manager->persist($encyclopedia_categories);
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
