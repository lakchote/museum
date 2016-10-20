<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Billet;
use AppBundle\Form\ShowBilletsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Tarif;
use AppBundle\Entity\Commande;
use Symfony\Component\HttpFoundation\Request;

class BilletsController extends Controller
{
    private $tarif;

    /**
     * @Route("/commande/{id}", name="app_billets")
     */
    public function billetsAction(Commande $commande, Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        if ($this->getDoctrine()->getRepository('AppBundle:Commande')->checkIfCommandeHasBillets($commande)) {
            return $this->render(':erreurs:commande_possede_billets.html.twig');
        }
        for ($i = 0; $i < $commande->getNbBillets(); $i++) {
            $billet = new Billet();
            $commande->addBillet($billet);
        }
        $form = $this->createForm(ShowBilletsType::class, $commande);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($commande->getBillets() as $billet) {
                if ($billet->getIsTarifReduit()) {
                    $this->tarif = $this->getDoctrine()->getRepository('AppBundle:Tarif')->findOneBy([
                        'nom' => 'reduit'
                    ]);
                } else {
                    $idTarif = $this->get('tarif_resolver')->getTarifForBillet($billet->getDateNaissance());
                    $this->tarif = $this->getDoctrine()->getRepository('AppBundle:Tarif')->find($idTarif);
                }
                $billet->setTarif($this->tarif);
            }
                $em->persist($commande);
                $em->flush();
                return $this->redirectToRoute('app_recapitulatif_commande', ['id' => $commande->getId()]);
        }
        return $this->render('billets.html.twig', [
            'commande' => $form->createView(),
            'id' => $id,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_delete_billets")
     */
    public function deleteAction(Commande $commande)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($commande);
        $em->flush();
        return $this->redirectToRoute('app_homepage');
    }
}
