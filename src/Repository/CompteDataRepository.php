<?php

namespace App\Repository;

use App\Entity\CompteData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompteData|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteData|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteData[]    findAll()
 * @method CompteData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompteData::class);
    }

    // /**
    //  * @return ContactData[] Returns an array of ContactData objects
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
    public function findOneBySomeField($value): ?ContactData
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
