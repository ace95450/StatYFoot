<?php

namespace App\Repository;

use App\Entity\AllMatchLeague;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AllMatchLeague|null find($id, $lockMode = null, $lockVersion = null)
 * @method AllMatchLeague|null findOneBy(array $criteria, array $orderBy = null)
 * @method AllMatchLeague[]    findAll()
 * @method AllMatchLeague[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AllMatchLeagueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AllMatchLeague::class);
    }

    // /**
    //  * @return AllMatchLeague[] Returns an array of AllMatchLeague objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AllMatchLeague
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
