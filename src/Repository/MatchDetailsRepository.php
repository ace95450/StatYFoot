<?php

namespace App\Repository;

use App\Entity\MatchDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MatchDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method MatchDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method MatchDetails[]    findAll()
 * @method MatchDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchDetailsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MatchDetails::class);
    }

    /**
     * Récupérer les derniers matchs
     */
    public function findLatest()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.fixture_id', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }


    /**
     * @param $idMatch
     * @param $idLegaue
     * @return mixed
     */
    public function findByFixtures($idMatch, $idLeague)
    {
        return $this->createQueryBuilder('a')
            ->where('a.fixture_id = :fixture_id')
            ->setParameter('fixture_id', $idMatch)

            ->andWhere('a.league_id = :league_id')
            ->setParameter('league_id', $idLeague)

            ->getQuery()
            ->getResult();
    }

}
