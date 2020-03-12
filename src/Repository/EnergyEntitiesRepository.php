<?php

namespace App\Repository;

use App\Entity\EnergyEntities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EnergyEntities|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnergyEntities|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnergyEntities[]    findAll()
 * @method EnergyEntities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnergyEntitiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnergyEntities::class);
    }

    // /**
    //  * @return EnergyEntities[] Returns an array of EnergyEntities objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EnergyEntities
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
