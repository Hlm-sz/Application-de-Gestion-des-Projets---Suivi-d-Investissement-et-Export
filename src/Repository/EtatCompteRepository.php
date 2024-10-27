<?php

namespace App\Repository;

use App\Entity\EtatCompte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EtatCompte|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtatCompte|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtatCompte[]    findAll()
 * @method EtatCompte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatCompteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtatCompte::class);
    }

    // /**
    //  * @return EtatCompte[] Returns an array of EtatCompte objects
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
    
    public function statutliste()
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.id in (:val)')
            ->setParameter('val',array(10,11,12))
            ->getQuery()
            ->getResult()
        ;
    }
    
}
