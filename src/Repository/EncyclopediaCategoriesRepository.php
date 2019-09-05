<?php

namespace App\Repository;

use App\Entity\EncyclopediaCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EncyclopediaCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method EncyclopediaCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method EncyclopediaCategories[]    findAll()
 * @method EncyclopediaCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EncyclopediaCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EncyclopediaCategories::class);
    }

    // /**
    //  * @return EncyclopediaCategories[] Returns an array of EncyclopediaCategories objects
    //  */
    
    // public function findLastCategories($limit)
    // {
    //     return $this->createQueryBuilder('e')
    //         ->select('t as title, d as description, c as cover, d as dateCreation, v as visible, s as slug')
    //         ->orderBy('dateCreation', 'DESC')
    //         ->setMaxResults($limit)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }
    

    /*
    public function findOneBySomeField($value): ?EncyclopediaCategories
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
