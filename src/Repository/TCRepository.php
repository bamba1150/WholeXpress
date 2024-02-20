<?php

namespace App\Repository;

use App\Entity\TC;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TC>
 *
 * @method TC|null find($id, $lockMode = null, $lockVersion = null)
 * @method TC|null findOneBy(array $criteria, array $orderBy = null)
 * @method TC[]    findAll()
 * @method TC[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TCRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TC::class);
    }

//    /**
//     * @return TC[] Returns an array of TC objects
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

//    public function findOneBySomeField($value): ?TC
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
