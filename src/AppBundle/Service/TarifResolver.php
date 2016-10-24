<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 20/10/2016
 * Time: 15:15
 */

namespace AppBundle\Service;

use AppBundle\Entity\Tarif;
use Doctrine\ORM\EntityManager;

class TarifResolver
{
    private $em;

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
}