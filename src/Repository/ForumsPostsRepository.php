<?php

namespace App\Repository;

use App\Entity\ForumsPosts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ForumsPosts|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumsPosts|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumsPosts[]    findAll()
 * @method ForumsPosts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumsPostsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ForumsPosts::class);
    }

    // /**
    //  * @return ForumsPosts[] Returns an array of ForumsPosts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ForumsPosts
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
