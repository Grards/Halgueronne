<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ComptesController extends AbstractController
{
    /**
     * @Route("/connexion", name="account_login")
     */
    public function connexion(AuthenticationUtils $utils){

        // La méthode getLastAuthenticationError renvoie une information (en anglais) s'il y a eu un problème avec le formulaire
        $errors = $utils->getLastAuthenticationError();
        // La méthode getLastUsername renvoie le dernier username introduit par l’utilisateur, afin de ne pas devoir retapper le login en cas d'erreur de mot de passe
        $username = $utils->getLastUsername();

        return $this->render('comptes/index.html.twig', [
            // S'il n'y a pas d'erreur retournée par getLastAuthenticationError, sa valeur est dès lors nulle.
            'hasError' => $errors!== null,
            'username' => $username
        ]);
    }

    /**
     * Permet de se déconnecter.
     * Fonctionne grâce à security.yaml, via le firewall logout.
     * @Route("/logout", name="account_logout")
     * @return void
     */
    public function logout(){}
}
