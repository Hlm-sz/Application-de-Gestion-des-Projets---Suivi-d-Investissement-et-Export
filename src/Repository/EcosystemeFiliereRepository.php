<?php

namespace App\Repository;

use App\Entity\EcosystemeFiliere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EcosystemeFiliere|null find($id, $lockMode = null, $lockVersion = null)
 * @method EcosystemeFiliere|null findOneBy(array $criteria, array $orderBy = null)
 * @method EcosystemeFiliere[]    findAll()
 * @method EcosystemeFiliere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcosystemeFiliereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EcosystemeFiliere::class);
    }

    // /**
    //  * @return EcosystemeFiliere[] Returns an array of EcosystemeFiliere objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EcosystemeFiliere
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
