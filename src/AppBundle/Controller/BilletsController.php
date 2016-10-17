<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Tarifs;
use AppBundle\Form\ShowBilletsFormType;
use AppBundle\Entity\Commandes;
use AppBundle\Entity\Billets;

class BilletsController extends Controller
{

    /**
     * @Route("/commande/{id}", name="app_billets")
     */
    public function billetsAction(Commandes $commande)
    {
        $quantiteBillets = $commande->getNbBillets();
        for($i = 0; $i < $quantiteBillets; $i++)
        {
            $billet = new Billets();
            $billet->setCommande($commande);
            $billet->setDateNaissance(new \DateTime());
            $billet->setPays('France');
            $billet->setTarif(1);
            $billet->setNom('Test');
            $billet->setPrenom('BLA');
            $tarif = new Tarifs();
            $tarif->setTypeTarif('Tarif_reduit');
            $billet->setTarif($tarif);
            $em = $this->getDoctrine()->getManager();
            $em->persist($billet);
            $em->persist($tarif);
            $em->flush();
        }
        $form = $this->createForm(ShowBilletsFormType::class, $commande);
        return $this->render('billets.html.twig',[
            'commande' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_delete_billets")
     */
    public function deleteAction(Commandes $commande)
    {
        $em = $this->getDoctrine()->getManager();
        foreach($commande->getBillets() as $billet)
        {
            $em->remove($billet);
            $em->flush();
        }
        $em->remove($commande);
        $em->flush();
        return $this->redirectToRoute('app_homepage');
    }
}
