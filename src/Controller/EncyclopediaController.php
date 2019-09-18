<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use App\Repository\EncyclopediaPostsRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EncyclopediaTopicsRepository;
use App\Repository\EncyclopediaCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EncyclopediaController extends AbstractController
{
    /**
     * @Route("/encyclopedie", name="encyclopedia", schemes={"https"})
     */
    public function index(EncyclopediaCategoriesRepository $categories, EncyclopediaTopicsRepository $topics, EncyclopediaPostsRepository $posts)
    {
        $encyclopedia_categories = $categories->findAll();
        $encyclopedia_topics = $topics->findAll();
        $last_posts = $posts->findBy(['visible' => 1], ['updateDate' => 'DESC'], 3);
        $last_3_posts = $posts->findLastPostsVisibles(3);
        return $this->render('encyclopedia/index.html.twig', [
            'encyclopedia_categories' => $encyclopedia_categories,
            'encyclopedia_topics' => $encyclopedia_topics,
            'last_posts' => $last_posts,
            'last_3_posts' => $last_3_posts
        ]);
    }

    /**
     * Permet d'afficher la liste des posts en regard d'un topic en particulier
     * @Route("/encyclopedie/topic/{categorySlug}/{topicSlug}", name="posts_list", schemes={"https"})
     */
    public function topicsList(EncyclopediaPostsRepository $repo_posts, EncyclopediaTopicsRepository $repo_topics, $categorySlug, $topicSlug)
    {
        $topic = $repo_topics->findOneBySlug($topicSlug);
        return $this->render('encyclopedia/posts.html.twig',[
            'topic' => $topic,
        ]);
    }

    /**
     * Permet d'afficher un article en particulier de l'encyclopédie
     * @Route("/encyclopedie/post/{categorySlug}/{topicSlug}/{postSlug}", name="post_show", schemes={"https"})
     */
    public function postShow(EncyclopediaPostsRepository $repo_posts, UsersRepository $repo_users, $categorySlug, $topicSlug, $postSlug)
    {
        $post = $repo_posts->findOneBySlug($postSlug);
        $users = $repo_users->findAll();
        return $this->render('encyclopedia/show.html.twig', [
            'post' => $post,
            'users' => $users
        ]);
    }
}
