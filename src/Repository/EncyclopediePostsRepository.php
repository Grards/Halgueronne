<?php

namespace App\Repository;

use App\Entity\EncyclopediePosts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EncyclopediePosts|null find($id, $lockMode = null, $lockVersion = null)
 * @method EncyclopediePosts|null findOneBy(array $criteria, array $orderBy = null)
 * @method EncyclopediePosts[]    findAll()
 * @method EncyclopediePosts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EncyclopediePostsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EncyclopediePosts::class);
    }

    // /**
    //  * @return EncyclopediePosts[] Returns an array of EncyclopediePosts objects
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
    public function findOneBySomeField($value): ?EncyclopediePosts
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
