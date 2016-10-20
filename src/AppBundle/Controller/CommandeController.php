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
    public function recapCommandeAction(Commande $commande)
    {
        dump($commande);die;
    }
}
