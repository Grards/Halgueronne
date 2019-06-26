<?php

namespace App\Repository;

use App\Entity\Characters;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Characters|null find($id, $lockMode = null, $lockVersion = null)
 * @method Characters|null findOneBy(array $criteria, array $orderBy = null)
 * @method Characters[]    findAll()
 * @method Characters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharactersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Characters::class);
    }

    /*
    * Retourne tous les personnages qui appartiennent à un utilisateur passé en paramètre
    */
    
    public function findCharactersOfUser($user){
        return $this->createQueryBuilder('u')
                    ->select('c.lastname as nom, c.firstname as prenom, c.gender as genre, c.picture as image, c.birthDay as naissJ, c.birthMonth as naissM, c.birthYear as naissA, c.deathDay as mortJ, c.deathMonth as mortM, c.deathYear as mortA, c.background as bio, c.user as utilisateur')
                    ->join('u.characters', 'c')
                    ->groupBy($user)
                    ->orderBy('c.lastname','c.firstname','ASC')
                    ->where('c.user' == $user)
                    ->getQuery()
                    ->getResult();
    }

    // /**
    //  * @return Characters[] Returns an array of Characters objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Characters
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
