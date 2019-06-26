<?php

namespace App\Controller;

use App\Entity\Characters;
use App\Form\CharacterType;
use App\Repository\CharactersRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CharactersController extends AbstractController
{
    /**
     * @Route("/characters", name="characters")
     */
    public function index()
    {
        return $this->render('characters/index.html.twig', [
            'controller_name' => 'CharactersController',
        ]);
    }

    /**
     * Permet d'ajouter un personnage
     * La propriété Request représente ici le POST
     * @Route("/personnage/creer", name="character_create")
     * @IsGranted("ROLE_USER")
     */
    public function characterCreate(Request $request, ObjectManager $manager){
        $characters = new Characters();
        $form = $this->createForm(CharacterType::class, $characters);
        // Fonction qui permet de parcourir la requête et d'extraire les information du form
        $form->handleRequest($request);

        // On vérifie si le formulaire n'est pas vide et s'il est valide, avant d'enregistrer le tout grâce au Manager en paramètre de la fonction create.
        if($form->isSubmitted() && $form->isValid()){

            $characters->setUser($this->getUser());
            
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
            'form' => $form->createView(),
        ]);
    }

    /**
     * Permet d'éditer un personnage
     * Doit se trouver avant /profil/{slug}, sinon il va considérer cette route comme étant un slug.
     * @Route("/personnage/modification", name="character_edit")
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function characterEdit(Characters $characters, Request $request, ObjectManager $manager){
        $user = $this->getUser();
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
            'form' => $form->createView(),
            'characters' => $characters,
            'user' => $user
        ]);
    }

    /**
     * Permet d'afficher un personnage en particulier
     * @Route("/personnage/{slug}", name="character_show")
     */
    public function characterShow(CharactersRepository $repo_character, $slug)
    {
        $characters = $repo_character->findOneBySlug($slug);
        return $this->render('characters/show.html.twig', [
            'character' => $characters
        ]);
    }
}
