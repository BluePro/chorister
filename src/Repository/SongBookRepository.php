<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\SongBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SongBook|null find($id, $lockMode = null, $lockVersion = null)
 * @method SongBook|null findOneBy(array $criteria, array $orderBy = null)
 * @method SongBook[]    findAll()
 * @method SongBook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @extends  ServiceEntityRepository<SongBook>
 */
class SongBookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SongBook::class);
    }

    // /**
    //  * @return SongBook[] Returns an array of SongBook objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SongBook
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
