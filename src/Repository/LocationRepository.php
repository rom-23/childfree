<?php

namespace App\Repository;

use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Location|null find($id, $lockMode = null, $lockVersion = null)
 * @method Location|null findOneBy(array $criteria, array $orderBy = null)
 * @method Location[]    findAll()
 * @method Location[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Location::class);
    }


    /**
     * @return Location[]
     * retourne les 6 derniers enregistrements, affiche sur page accueil product
     */
    public function findLatestLocation()
    {
        return $this -> findVisibleQuery()
            ->orderBy('p.id', 'desc')
            ->setMaxResults(6)
            -> getQuery()
            -> getResult();
    }

    /**
     * @return QueryBuilder
     */
    private function findVisibleQuery()
    {
        return $this -> createQueryBuilder( 'p' );
        //-> where( 'p.sold = 0' );
    }
}
