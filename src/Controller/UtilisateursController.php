<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\UtilisateursType;
use App\Repository\UtilisateursRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UtilisateursController extends AbstractController
{
    /**
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function index(UtilisateursRepository $repo)
    {
        $utilisateurs = $repo->findAll();
        return $this->render('utilisateurs/index.html.twig', [
            'controller_name' => 'UtilisateursController',
            'utilisateurs' => $utilisateurs
        ]);
    }

    /**
     * La propriété Request représente ici le POST
     * @Route("/utilisateurs/new", name="utilisateurs_create")
     */
    public function create(Request $request, ObjectManager $manager){
        $utilisateurs = new Utilisateurs();
        $form = $this->createForm(UtilisateursType::class, $utilisateurs);
        // Fonction qui permet de parcourir la requête et d'extraire les information du form
        $form->handleRequest($request);

        // On vérifie si le formulaire n'est pas vide et s'il est valide, avant d'enregistrer le tout grâce au Manager en paramètre de la fonction create.
        if($form->isSubmitted() && $form->isValid()){
            // Prévient qu'on veut sauver dans l'entité en paramètre
            $manager->persist($utilisateurs);
            // Envoie la requête SQL
            $manager->flush();

            $this->addFlash(
                'success',
                "L'utilisateur <strong>{$utilisateurs->getPseudo()}</strong> a bien été enregistré !"
            );

            // Redirection vers la page désirée une fois le formulaire envoyé.
            return $this->redirectToRoute('utilisateurs_show',['id'=>$utilisateurs->getId()]);
        }

        return $this->render('utilisateurs/new.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/utilisateurs/{id}", name="utilisateurs_show")
     */
    public function show(UtilisateursRepository $repo, $id)
    {
        $utilisateurs = $repo->find($id);
        return $this->render('utilisateurs/show.html.twig', [
            'utilisateurs' => $utilisateurs
        ]);
    }


}
