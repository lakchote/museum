<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 20/10/2016
 * Time: 15:50
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class TarifRepository extends EntityRepository
{
    public function returnTarifForBillet($age)
    {
        return $this->createQueryBuilder('tarif')
            ->select('tarif.id')
            ->andWhere('tarif.ageMin <= :age')
            ->andWhere('tarif.ageMax >= :age')
            ->setParameter('age', $age)
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleScalarResult();
    }
}