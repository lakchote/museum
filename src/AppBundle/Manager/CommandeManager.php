<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 26/10/2016
 * Time: 21:35
 */

namespace AppBundle\Manager;
use AppBundle\Entity\Billet;
use AppBundle\Entity\Commande;

class CommandeManager
{
    public function createBilletsForCommande(Commande $commande)
    {
        $quantite = $commande->getNbBillets();
        for ($i = 0; $i < $quantite; $i++) {
            $billet = new Billet();
            $commande->addBillet($billet);
        }

        return $commande;
    }
}
