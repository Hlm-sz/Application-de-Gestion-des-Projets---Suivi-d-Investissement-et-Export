<?php

namespace App\Repository;

use App\Entity\Secteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @method Secteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Secteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Secteur[]    findAll()
 * @method Secteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SecteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Secteur::class);
    }

    // /**
    //  * @return Secteur[] Returns an array of Secteur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Secteur
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /* public function getSecteurByUser(int $id_user)
    {
        return $this->createQueryBuilder('s')
            ->select('s.id')
            ->join('s.','u')
            ->andWhere('s.user = :val')
            ->setParameter('val', $id_user)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }*/

    public function ListsSecteursByComptes($user_id)
    {
        return $this->createQueryBuilder('s')
            ->join('s.comptes','c')
            ->join('c.responsableCompte','u')
            ->andWhere('u.id = :id')
            ->setParameter('id', $user_id)
            ->groupBy('s.id')
            ->getQuery()
            ->getResult()
            ;
    }

    public function ListsIdesSecteursByComptes($user_id)
    {
        return $this->createQueryBuilder('s')
            ->select('s.id')
            ->join('s.comptes','c')
            ->join('c.responsableCompte','u')
            ->andWhere('u.id = :id')
            ->setParameter('id', $user_id)
            ->groupBy('s.id')
            ->getQuery()
            ->getResult()
            ;
    }
    public function ListsSecteurs()
    {
        $qb = $this->createQueryBuilder('s');
        $qb->andWhere('s.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        return  $qb->getQuery()->execute();

    }

}
