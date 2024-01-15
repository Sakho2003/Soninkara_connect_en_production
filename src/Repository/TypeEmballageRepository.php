<?php

namespace App\Repository;

use App\Entity\TypeEmballage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeEmballage>
 *
 * @method TypeEmballage|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeEmballage|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeEmballage[]    findAll()
 * @method TypeEmballage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeEmballageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeEmballage::class);
    }

//    /**
//     * @return TypeEmballage[] Returns an array of TypeEmballage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeEmballage
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
