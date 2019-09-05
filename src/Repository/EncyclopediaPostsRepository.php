<?php

namespace App\Repository;

use App\Entity\EncyclopediaPosts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EncyclopediaPosts|null find($id, $lockMode = null, $lockVersion = null)
 * @method EncyclopediaPosts|null findOneBy(array $criteria, array $orderBy = null)
 * @method EncyclopediaPosts[]    findAll()
 * @method EncyclopediaPosts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EncyclopediaPostsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EncyclopediaPosts::class);
    }

    // /**
    //  * @return EncyclopediaPosts[] Returns an array of EncyclopediaPosts objects
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
    public function findOneBySomeField($value): ?EncyclopediaPosts
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
