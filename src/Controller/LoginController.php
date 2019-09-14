<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/connexion", name="account_login", schemes={"https"})
     */
    public function login(AuthenticationUtils $utils){

        // La méthode getLastAuthenticationError renvoie une information (en anglais) s'il y a eu un problème avec le formulaire
        $errors = $utils->getLastAuthenticationError();
        // La méthode getLastUsername renvoie le dernier login introduit par l’utilisateur, afin de ne pas devoir le retapper en cas d'erreur de mot de passe
        $login = $utils->getLastUsername();

        return $this->render('login/index.html.twig', [
            // S'il n'y a pas d'erreur retournée par getLastAuthenticationError, sa valeur est dès lors nulle.
            'hasError' => $errors!== null,
            'login' => $login
        ]);
    }

    /**
     * Permet de se déconnecter.
     * Fonctionne grâce à security.yaml, via le firewall logout.
     * @Route("/deconnexion", name="account_logout", schemes={"https"})
     * @return void
     */
    public function logout(){}
}
