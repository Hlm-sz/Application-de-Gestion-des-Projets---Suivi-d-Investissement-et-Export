<?php

namespace App\Repository;

use App\Entity\ListeExportateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListeExportateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListeExportateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListeExportateur[]    findAll()
 * @method ListeExportateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListeExportateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListeExportateur::class);
    }

    // /**
    //  * @return ListeExportateur[] Returns an array of ListeExportateur objects
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
    public function findOneBySomeField($value): ?ListeExportateur
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
