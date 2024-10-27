<?php

namespace App\Repository;

use App\Entity\ProjetsData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjetsData|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjetsData|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjetsData[]    findAll()
 * @method ProjetsData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetsDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjetsData::class);
    }

    // /**
    //  * @return ProjetsData[] Returns an array of ProjetsData objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProjetsData
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
