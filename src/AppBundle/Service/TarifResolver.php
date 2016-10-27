<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 20/10/2016
 * Time: 15:15
 */

namespace AppBundle\Service;

use AppBundle\Entity\Commande;
use AppBundle\Entity\Billet;
use AppBundle\Entity\Tarif;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TarifResolver
{
    private $em;
    private $tarif;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getTarifForBillet($birthDate)
    {
        $today = new \DateTime();
        $yearAsOfToday = $today->format('Y');
        $yearOfBirth = $birthDate->format('Y');
        if($yearOfBirth > $yearAsOfToday) {
            return false;
        }
        $age = $yearAsOfToday - $yearOfBirth;

        return $this->em->getRepository(Tarif::class)->returnTarifForBillet($age);
    }

    public function getTarifForEachBillet(Commande $commande)
    {
        foreach ($commande->getBillets() as $billet) {
            if ($billet->getIsTarifReduit()) {
                $this->tarif = $this->em->getRepository('AppBundle:Tarif')->findOneBy([
                    'nom' => 'reduit'
                ]);
            } else {
                if(!$this->tarif = $this->getTarifForBillet($billet->getDateNaissance())) {
                    throw new NotFoundHttpException('La date de naissance ne peut être supérieure à l\'année en cours.');
                }
            }
            $billet->setTarif($this->tarif);
        }
    }
}