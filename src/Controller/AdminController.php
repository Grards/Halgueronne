<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * Permet d'afficher tous les utilisateurs
     * @Route("/admin/liste_utilisateurs", name="admin_users_list")
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
     * @Route("/admin/liste_utilisateurs/{slug}/suppression", name="admin_user_delete")
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
     * @Route("/admin/liste_utilisateurs/{slug}/suppression_confirmation", name="admin_user_delete_confirm")
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
}
