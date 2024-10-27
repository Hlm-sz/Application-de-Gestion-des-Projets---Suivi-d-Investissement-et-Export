<?php

namespace App\Repository;

use App\Entity\PartenaireData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PartenaireData|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartenaireData|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartenaireData[]    findAll()
 * @method PartenaireData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartenaireDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PartenaireData::class);
    }

    // /**
    //  * @return PartenaireData[] Returns an array of PartenaireData objects
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
    public function findOneBySomeField($value): ?PartenaireData
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
