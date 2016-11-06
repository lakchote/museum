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
            ->where('tarif.ageMin <= :age')
            ->andWhere('tarif.ageMax >= :age')
            ->setParameter('age', $age)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
