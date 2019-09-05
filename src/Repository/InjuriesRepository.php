<?php

namespace App\Repository;

use App\Entity\Injuries;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Injuries|null find($id, $lockMode = null, $lockVersion = null)
 * @method Injuries|null findOneBy(array $criteria, array $orderBy = null)
 * @method Injuries[]    findAll()
 * @method Injuries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InjuriesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Injuries::class);
    }

    // /**
    //  * @return Injuries[] Returns an array of Injuries objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Injuries
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
