<?php

namespace App\Repository;

use App\Entity\InformationColis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InformationColis>
 *
 * @method InformationColis|null find($id, $lockMode = null, $lockVersion = null)
 * @method InformationColis|null findOneBy(array $criteria, array $orderBy = null)
 * @method InformationColis[]    findAll()
 * @method InformationColis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InformationColisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InformationColis::class);
    }

//    /**
//     * @return InformationColis[] Returns an array of InformationColis objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InformationColis
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
