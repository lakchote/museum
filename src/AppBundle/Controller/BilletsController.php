<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Billet;
use AppBundle\Form\ShowBilletsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Tarif;
use AppBundle\Entity\Commande;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BilletsController extends Controller
{
    private $tarif;

    /**
     * @Route("/commande/{id}", name="app_billets")
     */
    public function billetsAction(Commande $commande, Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        //Si la commande est finalisée, on ne peut plus y accéder
        if(!$this->get('commande_checker')->checkIfRequestIsValid($commande)) {
            return $this->render(':erreurs:commande_terminee.html.twig');
        }

        //Si la commande a déjà été persistée on ne crée pas de nouveaux billets
        if (!$this->getDoctrine()->getRepository('AppBundle:Commande')->checkIfCommandeHasBillets($commande)) {
            $commande = $this->get('commande_manager')->createBilletsForCommande($commande);
        }

        $form = $this->createForm(ShowBilletsType::class, $commande);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($commande->getBillets() as $billet) {
                /* TODO : Service tarif */
                if ($billet->getIsTarifReduit()) {
                    $this->tarif = $this->getDoctrine()->getRepository('AppBundle:Tarif')->findOneBy([
                        'nom' => 'reduit'
                    ]);
                } else {
                    //Si la date de naissance de l'utilisateur est supérieure à l'année en cours, on lève une exception
                    if(!$this->get('tarif_resolver')->getTarifForBillet($billet->getDateNaissance()))
                    {
                        throw new NotFoundHttpException('La date de naissance ne peut être supérieure à l\'année en cours.');
                    }
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
            'emailVisiteur' => $commande->getEmailVisiteur(),
            'dateVisite' => $commande->getDateVisite()
        ]);
    }
}
