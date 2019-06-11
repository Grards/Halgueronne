<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Repository\UtilisateursRepository;
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

    // /**
    //  * @Route("/utilisateurs/{id}", name="utilisateurs_show")
    //  */
    // public function show(Utiliateurs $utilisateurs)
    // {
    //     return $this->render('utilisateurs/show.html.twig', [
    //         'utilisateurs' => $utilisateurs
    //     ]);
    // }
}
