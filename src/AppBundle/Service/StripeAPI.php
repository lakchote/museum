<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 26/10/2016
 * Time: 22:19
 */

namespace AppBundle\Service;

use AppBundle\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;

class StripeAPI
{
    private $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }
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
            $translation = $this->translator->trans('content.payment_error', array(), 'paiement');
            $error = $translation. ' : ' . $e->getMessage();
        }
        return $error;
    }
}