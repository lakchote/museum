<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 20/10/2016
 * Time: 15:15
 */

namespace AppBundle\Service;

use AppBundle\Entity\Commande;
use AppBundle\Entity\Tarif;
use Doctrine\ORM\EntityManager;

class TarifResolver
{
    private $em;
    private $tarif;
    private $yearAsOfToday;
    private $error;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $today = new \DateTime();
        $this->yearAsOfToday = $today->format('Y');
    }

    private function getTarifForBillet(\DateTime $birthDate)
    {
        $yearOfBirth = $birthDate->format('Y');
        $age = $this->yearAsOfToday - $yearOfBirth;
        return $this->em->getRepository(Tarif::class)->returnTarifForBillet($age);
    }

    public function getTarifForEachBillet(Commande $commande)
    {
        foreach ($commande->getBillets() as $billet) {
            if ($billet->isTarifReduit()) {
                $this->tarif = $this->em->getRepository('AppBundle:Tarif')->findOneBy([
                    'nom' => 'reduit'
                ]);
            } else {
                $this->tarif = $this->getTarifForBillet($billet->getDateNaissance());
            }
            $billet->setTarif($this->tarif);
        }
    }
}
