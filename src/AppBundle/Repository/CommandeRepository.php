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


    public function isNotFinished($id)
    {
        return $this->createQueryBuilder('c')
            ->where('c.id = :id')
            ->andWhere('c.isFinished = 0')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function isEmailNotSentAndIsFinished($id)
    {
        return $this->createQueryBuilder('c')
            ->where('c.id = :id')
            ->andWhere('c.isEmailSent = 0')
            ->andWhere('c.isFinished = 1')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function isNotFinishedAndPriceNotNull($id)
    {
        return $this->createQueryBuilder('c')
            ->where('c.id = :id')
            ->andWhere('c.prixTotal != 0')
            ->andWhere('c.isFinished = 0')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
