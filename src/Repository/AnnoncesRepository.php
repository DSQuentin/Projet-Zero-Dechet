<?php

namespace App\Repository;

use App\Entity\Annonces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Annonces|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonces|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonces[]    findAll()
 * @method Annonces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnoncesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonces::class);
    }

    public function findThreeLastEntity()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.created_at', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findThreeLastEntityOfUser($user)
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.created_at', 'DESC')
            ->where('e.author = :author')
            ->setParameter('author', $user)
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByAuthor($author)
    {
        return $this->createQueryBuilder('e')
            ->where('e.author = :name')
            ->setParameter('name', $author)
            ->orderBy('e.created_at', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Annonces[] Returns an array of Annonces objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Annonces
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
