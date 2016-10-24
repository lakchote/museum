<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 20/10/2016
 * Time: 21:52
 */

namespace AppBundle\Service;


use AppBundle\Entity\Commande;

class TotalPrice
{
    private $totalPrice;

    /**
     * @param Commande $commande
     * @return integer
     */
    public function calculateTotalPrice(Commande $commande)
    {
        foreach ($commande->getBillets() as $billet)
        {
            $this->totalPrice += $billet->getTarif()->getPrix();
        }
        if($commande->getTypeBillet() == 'demi_journee') {
            $this->totalPrice = $this->totalPrice/2;
        }
        return (int)$this->totalPrice;
    }
}