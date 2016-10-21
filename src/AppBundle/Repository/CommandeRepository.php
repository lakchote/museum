<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 20/10/2016
 * Time: 16:40
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Commande;
use Doctrine\ORM\EntityRepository;

class CommandeRepository extends EntityRepository
{
    public function checkIfCommandeHasBillets(Commande $commande)
    {
        return $this->createQueryBuilder('commande')
            ->leftJoin('commande.billets', 'billets')
            ->andWhere('billets.commande = :commande')
            ->setParameter('commande', $commande)
            ->getQuery()
            ->execute();
    }


    public function checkIfIsFinished(Commande $commande)
    {
        return $this->createQueryBuilder('commande')
            ->select('commande.isFinished')
            ->andWhere('commande.id = :commande')
            ->setParameter('commande', $commande)
            ->getQuery()
            ->getSingleScalarResult();
    }
}