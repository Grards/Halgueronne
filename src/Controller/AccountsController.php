<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegisterType;
use Cocur\Slugify\Slugify;
use App\Repository\UsersRepository;
use App\Repository\CharactersRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AccountsController extends AbstractController
{
    /**
     * Permet de s'inscrire
     * La propriété Request représente ici le POST
     * @Route("/inscription", name="account_register", schemes={"https"})
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
                "Votre compte <strong>{$users->getLogin()}</strong> a été créé !"
            );

            // Redirection vers la page désirée une fois le formulaire envoyé.
            return $this->redirectToRoute('account_profile',['slug'=>$users->getSlug()]);
        }

        return $this->render('accounts/register.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * Permet d'éditer son compte. Seuls le propriétaire du compte et un admin peuvent accéder à cette page et modifier les informations de comptes.
     * Doit se trouver avant /profil/{slug}, sinon il va considérer cette route comme étant un slug.
     * @Route("/profil/modification", name="account_edit", schemes={"https"})
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function accountEdit(Request $request, ObjectManager $manager) {
        $user = $this->getUser();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // Hashage du mot de passe à l'inscription, sur base de l'agorithme décrit dans les encoders (security.yaml)
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                'Les données du profil ont été enregistrées'
            );

        }
        return $this->render("accounts/edit.html.twig",[
            'form' => $form->createView(),
            'users' => $user
        ]);
    }    

    /**
     * Permet d'afficher le profil utilisateur
     * @Route("/profil/{slug}", name="account_profile", schemes={"https"})
     */
    public function accountProfile(UsersRepository $repo_user, $slug)
    {
        $users = $repo_user->findOneBySlug($slug);
        return $this->render('accounts/profile.html.twig', [
            'users' => $users,
        ]);
    }

    
}
