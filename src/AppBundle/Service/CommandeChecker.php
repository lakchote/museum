<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 24/10/2016
 * Time: 10:27
 */

namespace AppBundle\Service;


use AppBundle\Entity\Commande;

class CommandeChecker
{
    private $em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function checkIfRequestIsValid(Commande $commande)
    {
        if ($this->em->getRepository('AppBundle:Commande')->checkIfIsFinished($commande) || $commande->getIsEmailSent()) {
            return false;
        }
        else {
            return true;
        }
    }
}