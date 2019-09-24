<?php

namespace App\Repository;

use App\Entity\EncyclopediaTopics;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EncyclopediaTopics|null find($id, $lockMode = null, $lockVersion = null)
 * @method EncyclopediaTopics|null findOneBy(array $criteria, array $orderBy = null)
 * @method EncyclopediaTopics[]    findAll()
 * @method EncyclopediaTopics[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EncyclopediaTopicsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EncyclopediaTopics::class);
    }

    public function findPostsOfTopicByUpdate($slug){
        return $this->createQueryBuilder('t')
                    ->select('p.title as title, p.post as post, p.creationDate as creationDate, p.updateDate as updateDate, p.visible as visible, p.slug as postSlug, t.slug as topicSlug, c.slug as categorySlug , c.cover as categoryCover, a.avatar as avatar')
                    ->join('t.encyclopediaPosts', 'p')
                    ->join('t.encyclopediaCategory', 'c')
                    ->join('p.author', 'a')
                    ->where('t.slug = :slug')
                    ->setParameter('slug', $slug)
                    ->orderBy('p.updateDate','DESC')
                    ->getQuery()
                    ->getResult();
    }

    // /**
    //  * @return EncyclopediaTopics[] Returns an array of EncyclopediaTopics objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EncyclopediaTopics
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
