<?php

namespace App\Controller;

use App\Repository\UsersRepository;
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
     * @Route("/admin/users_list", name="users_list")
     */
    public function usersList(UsersRepository $repo)
    {
        $users = $repo->findAll();
        return $this->render('admin/users_list.html.twig', [
            'users' => $users
        ]);
    }
}
