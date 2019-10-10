<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\EncyclopediaPosts;
use App\Form\EncyclopediaPostType;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EncyclopediaTopicsRepository;
use App\Repository\EncyclopediaCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin", schemes={"https"})
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * Permet d'afficher tous les utilisateurs
     * @Route("/admin/liste_utilisateurs", name="admin_users_list", schemes={"https"})
     */
    public function usersList(UsersRepository $repo)
    {
        $users = $repo->findAll();
        return $this->render('admin/users_list.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * Sélection d'un utilisateur à supprimer. Renvoie vers la demande de confirmation.
     *
     * @Route("/admin/liste_utilisateurs/{slug}/suppression", name="admin_user_delete", schemes={"https"})
     * 
     */
    
    public function userDelete(UsersRepository $repo_user, $slug)
    {
        $users = $repo_user->findOneBySlug($slug);
        return $this->render('admin/user_delete.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * Confirmation de suppression d'utilisateur
     * 
     * @Route("/admin/liste_utilisateurs/{slug}/suppression_confirmation", name="admin_user_delete_confirm", schemes={"https"})
     * 
     * @param Users $users
     * @param ObjectManager $manager
     * @return Response
     */

    public function userDeleteConfirm(Users $users, ObjectManager $manager){
        $manager->remove($users);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'utilisateur <strong>{$users->getLogin()}</strong> a bien été supprimé !"
        );

        return $this->redirectToRoute('admin');
    }

    /**
     * Edition de contenu pour l'enclyclopédie.
     * La propriété Request représente ici le POST
     * @Route("/admin/encyclopedie/edition/{slug}", name="encyclopedia_edit_post", schemes={"https"})
     * 
     */
    
    public function postEncyclopediaEdit(EncyclopediaPosts $post, Request $request, ObjectManager $manager){
        $post->setUpdateDate(new \DateTime());

        $form = $this->createForm(EncyclopediaPostType::class, $post);
        // Fonction qui permet de parcourir la requête et d'extraire les information du form
        $form->handleRequest($request);

        // On vérifie si le formulaire n'est pas vide et s'il est valide, avant d'enregistrer le tout grâce au Manager en paramètre de la fonction create.
        if($form->isSubmitted() && $form->isValid()){

            // Prévient qu'on veut sauver dans l'entité en paramètre
            $manager->persist($post);
            // Envoie la requête SQL
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre post <strong>{$post->getTitle()}</strong> a été édité !"
            );

            // Redirection vers la page désirée une fois le formulaire envoyé.
            return $this->redirectToRoute('post_show',['categorySlug'=>$post->getEncyclopediaTopic()->getEncyclopediaCategory()->getSlug(),'topicSlug'=>$post->getEncyclopediaTopic()->getSlug(),'postSlug'=>$post->getSlug()]);
        }

        return $this->render('admin/encyclopedia_edit_post.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Création de contenu pour l'enclyclopédie.
     * La propriété Request représente ici le POST
     * @Route("/admin/encyclopedie/nouveau_poste", name="encyclopedia_new_post", schemes={"https"})
     * 
     */
    
    public function postEncyclopediaCreate(Request $request, ObjectManager $manager){
        $post = new EncyclopediaPosts();

        // L'utilisateur qui crée le personnage est indiqué comme propriétaire de ce dernier.
        $post->setAuthor($this->getUser());

        $post->setCreationDate(new \DateTime());
        $post->setUpdateDate(new \DateTime());
        $post->setVisible(1);

        $form = $this->createForm(EncyclopediaPostType::class, $post);
        // Fonction qui permet de parcourir la requête et d'extraire les information du form
        $form->handleRequest($request);

        // On vérifie si le formulaire n'est pas vide et s'il est valide, avant d'enregistrer le tout grâce au Manager en paramètre de la fonction create.
        if($form->isSubmitted() && $form->isValid()){

            // Prévient qu'on veut sauver dans l'entité en paramètre
            $manager->persist($post);
            // Envoie la requête SQL
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre post <strong>{$post->getTitle()}</strong> a été créé !"
            );

            // Redirection vers la page désirée une fois le formulaire envoyé.
            return $this->redirectToRoute('post_show',['categorySlug'=>$post->getEncyclopediaTopic()->getEncyclopediaCategory()->getSlug(),'topicSlug'=>$post->getEncyclopediaTopic()->getSlug(),'postSlug'=>$post->getSlug()]);
        }

        return $this->render('admin/encyclopedia_new_post.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
