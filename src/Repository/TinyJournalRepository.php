<?php

namespace App\Repository;

use App\Entity\TinyJournal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TinyJournal|null find($id, $lockMode = null, $lockVersion = null)
 * @method TinyJournal|null findOneBy(array $criteria, array $orderBy = null)
 * @method TinyJournal[]    findAll()
 * @method TinyJournal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TinyJournalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TinyJournal::class);
    }

    public function listJTByProjet($id_projet)
    {
        return $this->createQueryBuilder('t')
            ->join('t.projet','p')
            ->andWhere('p.id = :id')
            ->setParameter('id', $id_projet)
            ->orderBy('t.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function listJTByProjetRecent($id_projet)
    {
        return $this->createQueryBuilder('t')
            ->join('t.projet','p')
            ->andWhere('p.id = :id')
            ->setParameter('id', $id_projet)
            ->orderBy('t.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

}
