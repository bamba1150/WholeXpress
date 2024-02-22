<?php

namespace App\Repository;


use App\Entity\CA;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AC>
 *
 * @method CA|null find($id, $lockMode = null, $lockVersion = null)
 * @method CA|null findOneBy(array $criteria, array $orderBy = null)
 * @method CA[]    findAll()
 * @method CA[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CARepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CA::class);
    }

//    /**
//     * @return CA[] Returns an array of AC objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AC
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
