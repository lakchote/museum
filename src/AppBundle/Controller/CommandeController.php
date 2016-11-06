<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commande;
use AppBundle\Form\Type\PaiementType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommandeController extends Controller
{

    /**
     * @Route("{_locale}/commande/recapitulatif/{id}", name="app_recapitulatif_commande")
     * @Method({"GET", "PATCH"})
     * @ParamConverter("commande", options={"repository_method" = "isNotFinished"})
     */
    public function recapCommandeAction(Commande $commande, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $commande->setPrixTotal($this->get('total_price_for_commande')->calculateTotalPrice($commande));
        $em->persist($commande);
        $em->flush();
        return $this->render('commande_controller/recapitulatif_commande.html.twig', [
            'commande' => $commande,
            '_locale' => $request->getLocale(),
        ]);
    }

    /**
     * @Route("{_locale}/paiement/{id}", name="app_paiement")
     * @Method({"GET", "POST"})
     * @ParamConverter("commande", options={"repository_method" = "isNotFinishedAndPriceNotNull"})
     */
    public function paymentAction(Commande $commande, Request $request)
    {
        $error = false;
        $form = $this->createForm(PaiementType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            $token = $request->get('stripeToken');
            $error = $this->get('stripe_api')->defineKey($this->getParameter('stripe_secret_key'))->createChargeForCustomer($commande, $token);
            if(!$error) {
                $em = $this->getDoctrine()->getManager();
                $commande->setFinished(true);
                $em->persist($commande);
                $em->flush();
                return $this->redirectToRoute('app_paiement_success', [
                    'id' => $commande->getId(),
                    '_locale' => $request->getLocale(),
                ]);
            }
        }
        return $this->render('commande_controller/paiement.html.twig', [
            'stripe_public_key' => $this->getParameter('stripe_public_key'),
            'error' => $error,
            'paiement' => $form->createView()
        ]);
    }

    /**
     * @Route("{_locale}/success/{id}", name="app_paiement_success")
     * @Method({"GET", "PATCH"})
     * @ParamConverter("commande", options={"repository_method" = "isEmailNotSentAndIsFinished"})
     */
    public function successAction(Commande $commande, Request $request)
    {
        $locale = $request->getLocale();
        $em = $this->getDoctrine()->getManager();
        $this->get('send_mail')->sendMailToUserWithCommande($commande, $locale);
        $commande->setEmailSent(true);
        $em->persist($commande);
        $em->flush();
        return $this->render('commande_controller/commande_finalisee.html.twig', [
            'commande' => $commande
        ]);
    }
}

