<?php

namespace App\Repository;

use App\Entity\LineUps;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LineUps|null find($id, $lockMode = null, $lockVersion = null)
 * @method LineUps|null findOneBy(array $criteria, array $orderBy = null)
 * @method LineUps[]    findAll()
 * @method LineUps[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LineUpsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LineUps::class);
    }

    // /**
    //  * @return LineUps[] Returns an array of LineUps objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LineUps
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
