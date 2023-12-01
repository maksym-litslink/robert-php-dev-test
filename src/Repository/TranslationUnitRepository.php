<?php

namespace App\Repository;

use App\Entity\TranslationUnit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TranslationUnit>
 *
 * @method TranslationUnit|null find($id, $lockMode = null, $lockVersion = null)
 * @method TranslationUnit|null findOneBy(array $criteria, array $orderBy = null)
 * @method TranslationUnit[]    findAll()
 * @method TranslationUnit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TranslationUnitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TranslationUnit::class);
    }

//    /**
//     * @return TranslationUnit[] Returns an array of TranslationUnit objects
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

//    public function findOneBySomeField($value): ?TranslationUnit
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
