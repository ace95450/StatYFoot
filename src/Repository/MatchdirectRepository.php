<?php

namespace App\Repository;

use App\Entity\Matchdirect;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Matchdirect|null find($id, $lockMode = null, $lockVersion = null)
 * @method Matchdirect|null findOneBy(array $criteria, array $orderBy = null)
 * @method Matchdirect[]    findAll()
 * @method Matchdirect[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchdirectRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Matchdirect::class);
    }

    // /**
    //  * @return Matchdirect[] Returns an array of Matchdirect objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Matchdirect
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
