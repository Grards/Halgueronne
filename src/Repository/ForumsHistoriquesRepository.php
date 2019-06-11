<?php

namespace App\Repository;

use App\Entity\ForumsHistoriques;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ForumsHistoriques|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumsHistoriques|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumsHistoriques[]    findAll()
 * @method ForumsHistoriques[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumsHistoriquesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ForumsHistoriques::class);
    }

    // /**
    //  * @return ForumsHistoriques[] Returns an array of ForumsHistoriques objects
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
    public function findOneBySomeField($value): ?ForumsHistoriques
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
