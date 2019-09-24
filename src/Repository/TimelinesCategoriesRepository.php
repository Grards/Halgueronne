<?php

namespace App\Repository;

use App\Entity\TimelinesCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TimelinesCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method TimelinesCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method TimelinesCategories[]    findAll()
 * @method TimelinesCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimelinesCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TimelinesCategories::class);
    }

    public function findTimelineOrderedByDate($slug){
        return $this->createQueryBuilder('c')
                    ->select('c.category as category, c.picture as categoryPicture, c.description as categoryDescription, c.slug as categorySlug, t.title as title, t.description as description, t.year as year, t.picture as picture')
                    ->join('c.timelines', 't')
                    ->where('c.slug = :slug')
                    ->setParameter('slug', $slug)
                    ->orderBy('t.year','DESC')
                    ->getQuery()
                    ->getResult();
    }


    // /**
    //  * @return TimelinesCategories[] Returns an array of TimelinesCategories objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TimelinesCategories
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
