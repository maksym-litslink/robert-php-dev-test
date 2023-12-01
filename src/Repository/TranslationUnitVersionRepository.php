<?php

namespace App\Repository;

use App\Entity\TranslationUnitVersion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TranslationUnitVersion>
 *
 * @method TranslationUnitVersion|null find($id, $lockMode = null, $lockVersion = null)
 * @method TranslationUnitVersion|null findOneBy(array $criteria, array $orderBy = null)
 * @method TranslationUnitVersion[]    findAll()
 * @method TranslationUnitVersion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TranslationUnitVersionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TranslationUnitVersion::class);
    }

//    /**
//     * @return TranslationUnitVersion[] Returns an array of TranslationUnitVersion objects
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

//    public function findOneBySomeField($value): ?TranslationUnitVersion
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
