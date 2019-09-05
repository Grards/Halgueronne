<?php

namespace App\Repository;

use App\Entity\Spells;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Spells|null find($id, $lockMode = null, $lockVersion = null)
 * @method Spells|null findOneBy(array $criteria, array $orderBy = null)
 * @method Spells[]    findAll()
 * @method Spells[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpellsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Spells::class);
    }

    // /**
    //  * @return Spells[] Returns an array of Spells objects
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
    public function findOneBySomeField($value): ?Spells
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
