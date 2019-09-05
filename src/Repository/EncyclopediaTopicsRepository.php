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
