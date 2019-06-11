<?php

namespace App\Repository;

use App\Entity\Blessures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Blessures|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blessures|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blessures[]    findAll()
 * @method Blessures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlessuresRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Blessures::class);
    }

    // /**
    //  * @return Blessures[] Returns an array of Blessures objects
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
    public function findOneBySomeField($value): ?Blessures
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
