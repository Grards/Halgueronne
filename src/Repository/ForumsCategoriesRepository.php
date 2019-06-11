<?php

namespace App\Repository;

use App\Entity\ForumsCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ForumsCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumsCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumsCategories[]    findAll()
 * @method ForumsCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumsCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ForumsCategories::class);
    }

    // /**
    //  * @return ForumsCategories[] Returns an array of ForumsCategories objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ForumsCategories
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
