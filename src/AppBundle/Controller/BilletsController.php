<?php

namespace AppBundle\Controller;

use AppBundle\Form\ShowBilletsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Commande;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class BilletsController extends Controller
{

    /**
     * @Route("{_locale}/commande/{id}", name="app_billets", requirements={"_locale" = "fr|en"})
     * @ParamConverter("commande", options={"repository_method" = "isNotFinished"})
     */
    public function billetsAction(Commande $commande, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //Si la commande a déjà été persistée on ne crée pas de nouveaux billets
        if (!$this->getDoctrine()->getRepository('AppBundle:Commande')->checkIfCommandeHasBillets($commande)) {
            $commande = $this->get('commande_manager')->createBilletsForCommande($commande);
        }
        $form = $this->createForm(ShowBilletsType::class, $commande);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           $this->get('tarif_resolver')->getTarifForEachBillet($commande);
            $em->persist($commande);
            $em->flush();
            return $this->redirectToRoute('app_recapitulatif_commande', ['id' => $commande->getId()]);
        }
        return $this->render('billets.html.twig', [
            'commande' => $form->createView(),
        ]);
    }
}
