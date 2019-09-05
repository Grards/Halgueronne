<?php

namespace App\Controller;

use \stdClass;
use App\Entity\Characters;
use App\Form\CharacterType;
use App\Service\PaginationService;
use App\Repository\RacesRepository;
use App\Repository\UsersRepository;
use App\Repository\SkillsRepository;
use App\Repository\SpellsRepository;
use App\Repository\ClassesRepository;
use App\Repository\CharactersRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CharactersController extends AbstractController
{
    /**
     * @Route("/personnages/liste", name="characters_list", schemes={"https"})
     */
    public function charactersList(CharactersRepository $repo_characters)
    {
        $characters = $repo_characters->findBy([], ['lastname' => 'ASC'] );
        return $this->render('characters/list.html.twig', [
            'characters' => $characters,
        ]);
    }

    /**
     * @Route("/personnages/recherche", name="characters_search", schemes={"https"})
     */
    public function charactersSearch(CharactersRepository $repo_characters, Request $request){
        $search = $request->query->get('search');
        $result = $repo_characters->findCharacterByName($search);
        return $this->render('characters/search.html.twig', [
            'result' => $result,
            'search' => $search
        ]);
    }

    /**
     * @Route("/personnages/{slug}", name="characters", schemes={"https"})
     */
    public function index(UsersRepository $repo_user, $slug)
    {
        $users = $repo_user->findOneBySlug($slug);
        return $this->render('characters/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * Permet d'ajouter un personnage
     * La propriété Request représente ici le POST
     * @Route("/personnage/creer", name="character_create", schemes={"https"})
     * @IsGranted("ROLE_USER")
     */
    public function characterCreate(Request $request, ObjectManager $manager){
        $characters = new Characters();

        $form = $this->createForm(CharacterType::class, $characters);
        // Fonction qui permet de parcourir la requête et d'extraire les information du form
        $form->handleRequest($request);

        // On vérifie si le formulaire n'est pas vide et s'il est valide, avant d'enregistrer le tout grâce au Manager en paramètre de la fonction create.
        if($form->isSubmitted() && $form->isValid()){

            // L'utilisateur qui crée le personnage est indiqué comme propriétaire de ce dernier.
            $characters->setUser($this->getUser());

            $skills=$form->get('skills')->getData();

            for($j=1; $j <= count($skills); $j++){
                $skill = $skills[$j-1];
                $characters->addSkill($skill);
            }

            // Prévient qu'on veut sauver dans l'entité en paramètre
            $manager->persist($characters);
            // Envoie la requête SQL
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre personnage <strong>{$characters->getFirstname()} {$characters->getLastname()}</strong> a été créé !"
            );

            // Redirection vers la page désirée une fois le formulaire envoyé.
            return $this->redirectToRoute('character_show',['slug'=>$characters->getSlug()]);
        }

        return $this->render('characters/create.html.twig',[
            'form' => $form->createView()
        ]);
    }


    /**
     * Permet d'afficher un personnage en particulier
     * @Route("/personnage/{slug}", name="character_show", schemes={"https"})
     */
    public function characterShow(CharactersRepository $repo_character, $slug)
    {
        $characters = $repo_character->findOneBySlug($slug);
        return $this->render('characters/show.html.twig', [
            'character' => $characters
        ]);
    }

    
    /**
     * Permet d'éditer un personnage
     * Doit se trouver avant /profil/{slug}, sinon il va considérer cette route comme étant un slug.
     * @Route("/personnage/{slug}/modification", name="character_edit", schemes={"https"})
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function characterEdit(Characters $characters, Request $request, ObjectManager $manager){
        $form = $this->createForm(CharacterType::class, $characters);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($characters);
            $manager->flush();
            $this->addFlash(
                'success',
                "Vote personnage <strong>{$characters->getFirstname()} {$characters->getLastname()}</strong> a bien été modifié !"
            );
            return $this->redirectToRoute('character_show',[
                'slug' => $characters->getSlug()
            ]);
        }

        return $this->render('characters/edit.html.twig',[
            'characters' => $characters,
            'form' => $form->createView()
        ]);
    }
}
