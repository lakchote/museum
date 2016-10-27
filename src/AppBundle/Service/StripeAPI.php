<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 26/10/2016
 * Time: 22:19
 */

namespace AppBundle\Service;

use AppBundle\Entity\Commande;

class StripeAPI
{
    public function defineKey($apiKEY)
    {
        \Stripe\Stripe::setApiKey($apiKEY);
        return $this;
    }

    public function createChargeForCustomer(Commande $commande, $token)
    {
        $error = false;
        try {
            \Stripe\Charge::create([
                'amount' => $commande->getPrixTotal() * 100,
                'currency' => 'eur',
                'source' => $token,
                'description' => 'Commande de billets pour le musée du Louvre'
            ]);
        } catch (\Stripe\Error\Card $e) {
            $error = ' Il y a eu un problème lors du paiement : ' . $e->getMessage();
        }
        return $error;
    }
}