<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commande;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommandeController extends Controller
{

    /**
     * @Route("/commande/recapitulatif/{id}", name="app_recapitulatif_commande")
     */
    public function recapCommandeAction(Commande $commande) {
        if(!$this->get('commande_checker')->checkIfRequestIsValid($commande)) {
            return $this->render(':erreurs:commande_terminee.html.twig');
        }
        $em = $this->getDoctrine()->getManager();
        $commande->setPrixTotal($this->get('total_price_for_commande')->calculateTotalPrice($commande));
        $em->persist($commande);
        $em->flush();
        return $this->render('recapitulatif_commande.html.twig', [
            'commande' => $commande,
        ]);
    }

    /**
     * @Route("/paiement/{id}", name="app_paiement")
     */
    public function paymentAction(Commande $commande, Request $request)
    {
        if(!$this->get('commande_checker')->checkIfRequestIsValid($commande)) {
            return $this->render(':erreurs:commande_terminee.html.twig');
        }
        $error = false;
        if($request->isMethod('POST')) {
            $token = $request->get('stripeToken');
            $error = $this->get('stripe_api')->defineKey($this->getParameter('stripe_secret_key'))->createChargeForCustomer($commande, $token);
            if(!$error) {
                $em = $this->getDoctrine()->getManager();
                $commande->setIsFinished(true);
                $em->persist($commande);
                $em->flush();
                return $this->redirectToRoute('app_paiement_success', [
                    'id' => $commande->getId()
                ]);
            }
        }
        return $this->render('paiement.html.twig', [
            'stripe_public_key' => $this->getParameter('stripe_public_key'),
            'error' => $error,
        ]);
    }

    /**
     * @Route("/success/{id}", name="app_paiement_success")
     */
    public function successAction(Commande $commande)
    {
       /* if(!$this->get('commande_checker')->checkIfRequestIsValid($commande)) {
            return $this->render(':erreurs:commande_terminee.html.twig');
        }*/
        $em = $this->getDoctrine()->getManager();
        $this->get('send_mail')->sendMailToUserWithCommande($commande);
        $commande->setIsEmailSent(true);
        $em->persist($commande);
        $em->flush();
        return $this->render('commande_finalisee.html.twig', [
            'commande' => $commande
        ]);
    }
}

