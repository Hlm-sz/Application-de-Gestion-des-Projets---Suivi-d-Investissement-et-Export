<?php

namespace App\Repository;

use App\Entity\CarteVisite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarteVisite|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteVisite|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteVisite[]    findAll()
 * @method CarteVisite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteVisiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteVisite::class);
    }

    // /**
    //  * @return CarteVisite[] Returns an array of CarteVisite objects
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
    public function findOneBySomeField($value): ?CarteVisite
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getCarteVistesByCompte($compte)
    {
        return $this->createQueryBuilder('v')
            ->select('v')
            ->join('v.contact','c')
            ->join('v.compte','cm')
            ->andWhere('cm.id = :id_compte')
            ->setParameter('id_compte', $compte)
            ->orderBy('v.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function getCarteVistesByContact($contact)
    {
        return $this->createQueryBuilder('v')
            ->select('v')
            ->join('v.contact','c')
            ->andWhere('c.id = :id_contact')
            ->setParameter('id_contact', $contact)
            ->orderBy('v.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function getCVByCompte($compte)
    {
        return $this->createQueryBuilder('v')
            ->select('v')
            ->join('v.contact','c')
            ->join('v.compte','cm')
            ->andWhere('cm.id = :id_compte')
            ->setParameter('id_compte', $compte)
            ->orderBy('v.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function getCarteVistesByCompteContact($compte,$contact)
    {
        return $this->createQueryBuilder('v')
            ->select('v')
            ->join('v.contact','c')
            ->join('v.compte','cm')
            ->andWhere('cm.id = :id_compte')
            ->setParameter('id_compte', $compte)
            ->andWhere('c.id = :id_contact')
            ->setParameter('id_contact', $contact)
            ->orderBy('v.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
}
