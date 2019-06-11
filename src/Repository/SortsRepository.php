<?php

namespace App\Repository;

use App\Entity\Sorts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sorts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sorts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sorts[]    findAll()
 * @method Sorts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sorts::class);
    }

    // /**
    //  * @return Sorts[] Returns an array of Sorts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sorts
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
