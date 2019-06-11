<?php

namespace App\Repository;

use App\Entity\EncyclopedieSujets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EncyclopedieSujets|null find($id, $lockMode = null, $lockVersion = null)
 * @method EncyclopedieSujets|null findOneBy(array $criteria, array $orderBy = null)
 * @method EncyclopedieSujets[]    findAll()
 * @method EncyclopedieSujets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EncyclopedieSujetsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EncyclopedieSujets::class);
    }

    // /**
    //  * @return EncyclopedieSujets[] Returns an array of EncyclopedieSujets objects
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
    public function findOneBySomeField($value): ?EncyclopedieSujets
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
