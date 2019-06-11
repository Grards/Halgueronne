<?php

namespace App\Repository;

use App\Entity\EncyclopedieCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EncyclopedieCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method EncyclopedieCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method EncyclopedieCategories[]    findAll()
 * @method EncyclopedieCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EncyclopedieCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EncyclopedieCategories::class);
    }

    // /**
    //  * @return EncyclopedieCategories[] Returns an array of EncyclopedieCategories objects
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
    public function findOneBySomeField($value): ?EncyclopedieCategories
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
