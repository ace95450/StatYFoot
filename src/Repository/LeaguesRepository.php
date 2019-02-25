<?php

namespace App\Repository;

use App\Entity\Leagues;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Leagues|null find($id, $lockMode = null, $lockVersion = null)
 * @method Leagues|null findOneBy(array $criteria, array $orderBy = null)
 * @method Leagues[]    findAll()
 * @method Leagues[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeaguesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Leagues::class);
    }

    // /**
    //  * @return Leagues[] Returns an array of Leagues objects
    //  */

    public function findByLogo($value)
    {
        return $this->createQueryBuilder('a')
            ->addSelect('a')
            ->join('a.country', 'c')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Leagues
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
