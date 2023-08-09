<?php

namespace App\Repository;

use App\Entity\VOD;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VOD>
 *
 * @method VOD|null find($id, $lockMode = null, $lockVersion = null)
 * @method VOD|null findOneBy(array $criteria, array $orderBy = null)
 * @method VOD[]    findAll()
 * @method VOD[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VODRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VOD::class);
    }

//    /**
//     * @return VOD[] Returns an array of VOD objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VOD
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
