<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 16/10/2016
 * Time: 16:55
 */

namespace AppBundle\Controller;

use AppBundle\Form\Type\CommandeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/{_locale}", name="app_homepage")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(CommandeType::class);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $commande = $form->getData();
            $em->persist($commande);
            $em->flush();
            return $this->redirectToRoute('app_billets', [
                'id' => $commande->getId(),
                '_locale' => $request->getLocale()
            ]);
        }
        return $this->render('index_controller/index.html.twig', [
            'commande' => $form->createView()
        ]);
    }

    /**
     * @Route("/{_locale}/cgv", name="app_cgv")
     * @Method({"GET"})
     */
    public function cgvAction()
    {
        return $this->render('index_controller/cgv.html.twig');
    }
}
