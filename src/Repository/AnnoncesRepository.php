<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Annonces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Annonces|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonces|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonces[]    findAll()
 * @method Annonces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnoncesRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private PaginatorInterface $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Annonces::class);
        $this->paginator = $paginator;
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

    public function findSearch(SearchData $searchData)
    {
        $query = $this
            ->createQueryBuilder('a')
            ->select('v', 'a')
            ->join('a.ville', 'v');

        if (!empty($searchData->q)){
            $query = $query
                ->where('a.title LIKE :q')
                ->setParameter('q', "%{$searchData->q}%");
        }

        if (!empty($searchData->villes)){
            $query = $query
                ->andWhere('v.id IN (:villes)')
                ->setParameter('villes', $searchData->villes);
        }

        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $searchData->page,
            12
        );
    }
}
