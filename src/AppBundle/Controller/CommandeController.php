<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commande;
use AppBundle\Entity\Billet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommandeController extends Controller
{
    /**
     * @Route("/commande/recapitulatif/{id}", name="app_recapitulatif_commande")
     */
    public function recapCommandeAction(Commande $commande) {
        $totalPrice = $this->get('total_price_for_commande')->calculateTotalPrice($commande);
        return $this->render('recapitulatif_commande.html.twig', [
            'commande' => $commande,
            'totalPrice' => $totalPrice
        ]);
    }
}
