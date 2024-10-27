<?php

namespace App\Repository;

use App\Entity\Permission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Permission|null find($id, $lockMode = null, $lockVersion = null)
 * @method Permission|null findOneBy(array $criteria, array $orderBy = null)
 * @method Permission[]    findAll()
 * @method Permission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PermissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Permission::class);
    }

    // /**
    //  * @return Permission[] Returns an array of Permission objects
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
    public function findOneBySomeField($value): ?Permission
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function getCount()
    {
        return $this
            ->createQueryBuilder('p')
            ->select("count(p.id)")
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getRequiredDTData($start, $length, $orders, $search, $columns, $otherConditions)
    {
        $query = $this->createQueryBuilder('p');

        $countQuery = $this->createQueryBuilder('p');
        $countQuery->select('COUNT(p)');

        if ($otherConditions === null) {
            $query->where("1=1");
            $countQuery->where("1=1");
        } else {
            $query->where($otherConditions);
            $countQuery->where($otherConditions);
        }


        if ($search['value'] != '') {
            $searchItem = $search['value'];

            $searchQuery = null;
            $searchQuery = 'p.nom LIKE \'%' . $searchItem . '%\' or p.nomConstant LIKE \'%' . $searchItem . '%\' ';

            if ($searchQuery !== null) {
                $query->andWhere($searchQuery);
                $countQuery->andWhere($searchQuery);
            }
        }


        $query->setFirstResult($start)->setMaxResults($length);

        foreach ($orders as $key => $order) {
            if ($order['name'] != '') {
                $orderColumn = null;

                switch ($order['name']) {
                    case 'nom': {
                            $orderColumn = 'p.nom';
                            break;
                        }
                    case 'nomConstant': {
                            $orderColumn = 'p.nomConstant';
                            break;
                        }
                    case 'isActive': {
                            $orderColumn = 'p.isActive';
                            break;
                        }
                }

                if ($orderColumn !== null) {
                    $query->orderBy($orderColumn, $order['dir']);
                }
            }
        }

        $results = $query->getQuery()->getResult();
        $countResult = $countQuery->getQuery()->getSingleScalarResult();

        return array(
            "results"         => $results,
            "countResult"    => $countResult
        );
    }


    public function getListPermissions($acces = true)
    {
        return $this->createQueryBuilder('a')
            ->select('a.id,a.nom')
            ->andWhere('a.isActive = :is_active')
            ->setParameter('is_active', $acces)
            ->getQuery()
            ->getArrayResult();
    }
    public function getListePermissionByAcces(int $acces, $is_acces = true)
    {
        return $this->createQueryBuilder('a')
            ->select('a.id')
            ->join('a.acces', 'ac')
            ->andWhere('ac.id = :acces')
            ->andWhere('a.isActive = :is_active')
            ->setParameter('acces', $acces)
            ->setParameter('is_active', $is_acces)
            ->getQuery()
            ->getArrayResult();
    }
}
