<?php

namespace App\Repository;

use App\Entity\SuiviColis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SuiviColis>
 *
 * @method SuiviColis|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuiviColis|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuiviColis[]    findAll()
 * @method SuiviColis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuiviColisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuiviColis::class);
    }

//    /**
//     * @return SuiviColis[] Returns an array of SuiviColis objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SuiviColis
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
