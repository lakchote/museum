<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 16/10/2016
 * Time: 16:55
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Commandes;
use AppBundle\Form\CommandeFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(CommandeFormType::class);

        $form->handleRequest($request);

        //Si la requête est de type POST et que les contraintes liées aux entités sont respectées
        if ($form->isSubmitted() && $form->isValid()) {
            //On récupère les données du formulaire qui est un objet de type CommandeModel
            $commande_Model = $form->getData();

            //On instancie notre service avec l'objet pour pouvoir effectuer les vérifications nécessaires
            $this->get('form_validator')->init($commande_Model);

            /*** Vérification email ***/
            $returnEmailValue = $this->get('form_validator')->checkEmail();
            if (!$returnEmailValue) {
                $this->addFlash('error', 'Les deux emails ne sont pas identiques.');
                return $this->redirectToRoute('app_homepage');
            }
            /*** Fin vérification email ***/

            /*** Vérification date ***/
            $returnDateValue = $this->get('form_validator')->checkDate();
            //Si jour passé
            if (!$returnDateValue) {
                $this->addFlash('error', 'Vous ne pouvez réserver un billet pour une date déjà passée.');
                return $this->redirectToRoute('app_homepage');
            } //Si jour sélectionné est un dimanche ou un mardi
            else if ($returnDateValue === 'Bad_day') {
                $this->addFlash('error', 'Vous ne pouvez réserver un billet pour le Mardi ou le dimanche.');
                $this->redirectToRoute('app_homepage');
            } //Si jour sélectionné est un jour férié
            else if ($returnDateValue === 'Jour_ferie') {
                $this->addFlash('error', 'Le musée est fermé les jours fériés.');
                return $this->redirectToRoute('app_homepage');
            }
            /*** Fin vérification date ***/

            /*** Persist de la commande ***/
            else {
                $commande = new Commandes();
                  $em = $this->getDoctrine()->getManager();
                  $commande->setDateVisite($commande_Model->getDateVisite());
                  $commande->setEmailVisiteur($commande_Model->getEmailVisiteur());
                  $commande->setNbBillets($commande_Model->getNbBillets());
                  $commande->setTypeBillet($commande_Model->getTypeBillet());
                  $em->persist($commande);
                  $em->flush($commande);
                  return $this->redirectToRoute('app_billets', [
                      'id' => $commande->getId(),
                  ]);
            }
        }
        return $this->render('index.html.twig', [
            'commande' => $form->createView()
        ]);
    }
}