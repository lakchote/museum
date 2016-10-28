<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commande;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommandeController extends Controller
{

    /**
     * @Route("/commande/recapitulatif/{id}", name="app_recapitulatif_commande")
     * @ParamConverter("commande", options={"repository_method" = "isNotFinished"})
     */
    public function recapCommandeAction(Commande $commande) {
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
     * @ParamConverter("commande", options={"repository_method" = "isNotFinishedAndPriceNotNull"})
     */
    public function paymentAction(Commande $commande, Request $request)
    {
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
     * @ParamConverter("commande", options={"repository_method" = "isEmailNotSentAndIsFinished"})
     */
    public function successAction(Commande $commande)
    {
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

