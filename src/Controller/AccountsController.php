<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegisterType;
use Cocur\Slugify\Slugify;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountsController extends AbstractController
{
    /**
     * @Route("/login", name="account_login")
     */
    public function login(AuthenticationUtils $utils){

        // La méthode getLastAuthenticationError renvoie une information (en anglais) s'il y a eu un problème avec le formulaire
        $errors = $utils->getLastAuthenticationError();
        // La méthode getLastUsername renvoie le dernier login introduit par l’utilisateur, afin de ne pas devoir le retapper en cas d'erreur de mot de passe
        $login = $utils->getLastUsername();

        return $this->render('accounts/login.html.twig', [
            // S'il n'y a pas d'erreur retournée par getLastAuthenticationError, sa valeur est dès lors nulle.
            'hasError' => $errors!== null,
            'login' => $login
        ]);
    }

    /**
     * Permet de se déconnecter.
     * Fonctionne grâce à security.yaml, via le firewall logout.
     * @Route("/logout", name="account_logout")
     * @return void
     */
    public function logout(){}


    /**
     * Permet de s'inscrire
     * La propriété Request représente ici le POST
     * @Route("/account/register", name="account_register")
     */
    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){
        $users = new Users();
        $form = $this->createForm(RegisterType::class, $users);
        // Fonction qui permet de parcourir la requête et d'extraire les information du form
        $form->handleRequest($request);

        // On vérifie si le formulaire n'est pas vide et s'il est valide, avant d'enregistrer le tout grâce au Manager en paramètre de la fonction create.
        if($form->isSubmitted() && $form->isValid()){
            // Hashage du mot de passe à l'inscription, sur base de l'agorithme décrit dans les encoders (security.yaml)
            $hash = $encoder->encodePassword($users, $users->getPassword());
            $users->setPassword($hash);

            // Prévient qu'on veut sauver dans l'entité en paramètre
            $manager->persist($users);
            // Envoie la requête SQL
            $manager->flush();

            $this->addFlash(
                'success',
                "Your account <strong>{$users->getLogin()}</ strong> has been created !"
            );

            // Redirection vers la page désirée une fois le formulaire envoyé.
            return $this->redirectToRoute('user',['slug'=>$users->getSlug()]);
        }

        return $this->render('accounts/register.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * Permet d'afficher le profil utilisateur
     * @Route("/account/{slug}", name="account_profile")
     */
    public function accountProfile(UsersRepository $repo, $slug)
    {
        $users = $repo->findOneBySlug($slug);
        return $this->render('accounts/profile.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * Permet d'éditer son compte
     * @Route("/account/{slug}/edit", name="account_edit")
     * @return Response
     */
    public function accountEdit(Users $users, Request $request, ObjectManager $manager){
        $form = $this->createForm(UsersType::class, $users);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($users);
            $manager->flush();
            $this->addFlash(
                'success',
                "Your account <strong>{$users->getLogin()}</strong> has been edited successfully !"
            );
            return $this->redirectToRoute('account_profile',[
                'slug' => $users->getSlug()
            ]);
        }

        return $this->render('accounts/edit.html.twig',[
            'form' => $form->createView(),
            'users' => $users
        ]);
    }

}
