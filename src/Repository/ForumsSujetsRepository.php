<?php

namespace App\Repository;

use App\Entity\ForumsSujets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ForumsSujets|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumsSujets|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumsSujets[]    findAll()
 * @method ForumsSujets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumsSujetsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ForumsSujets::class);
    }

    // /**
    //  * @return ForumsSujets[] Returns an array of ForumsSujets objects
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
    public function findOneBySomeField($value): ?ForumsSujets
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
