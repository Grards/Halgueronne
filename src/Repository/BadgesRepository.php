<?php

namespace App\Repository;

use App\Entity\Badges;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Badges|null find($id, $lockMode = null, $lockVersion = null)
 * @method Badges|null findOneBy(array $criteria, array $orderBy = null)
 * @method Badges[]    findAll()
 * @method Badges[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BadgesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Badges::class);
    }

    // /**
    //  * @return Badges[] Returns an array of Badges objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Badges
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}