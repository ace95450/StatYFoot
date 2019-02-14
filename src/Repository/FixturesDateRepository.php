<?php

namespace App\Repository;

use App\Entity\FixturesDate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FixturesDate|null find($id, $lockMode = null, $lockVersion = null)
 * @method FixturesDate|null findOneBy(array $criteria, array $orderBy = null)
 * @method FixturesDate[]    findAll()
 * @method FixturesDate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FixturesDateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FixturesDate::class);
    }

    // /**
    //  * @return FixturesDate[] Returns an array of FixturesDate objects
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
    public function findOneBySomeField($value): ?FixturesDate
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
