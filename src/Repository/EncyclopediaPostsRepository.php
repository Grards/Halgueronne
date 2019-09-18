<?php

namespace App\Repository;

use App\Entity\EncyclopediaPosts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EncyclopediaPosts|null find($id, $lockMode = null, $lockVersion = null)
 * @method EncyclopediaPosts|null findOneBy(array $criteria, array $orderBy = null)
 * @method EncyclopediaPosts[]    findAll()
 * @method EncyclopediaPosts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EncyclopediaPostsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EncyclopediaPosts::class);
    }

    public function findLastPostsVisibles($number){
        return $this->createQueryBuilder('p')
                    ->select('p.title as title, p.post as post, p.creationDate as creationDate, p.updateDate as updateDate, p.visible as visible, p.slug as slug, c.cover as cover')
                    ->join('p.encyclopediaTopic', 't')
                    ->join('t.encyclopediaCategory', 'c')
                    ->where('p.visible = 1')
                    ->andWhere('t.visible = 1')
                    ->andWhere('c.visible = 1')
                    ->orderBy('p.updateDate','DESC')
                    ->setMaxResults($number)
                    ->getQuery()
                    ->getResult();
    }

    // /**
    //  * @return EncyclopediaPosts[] Returns an array of EncyclopediaPosts objects
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
    public function findOneBySomeField($value): ?EncyclopediaPosts
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
