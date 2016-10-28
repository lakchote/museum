<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 16/10/2016
 * Time: 16:55
 */

namespace AppBundle\Controller;

use AppBundle\Form\CommandeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/{_locale}", name="app_homepage",requirements={"_locale" = "fr|en"})
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
        return $this->render('index.html.twig', [
            'commande' => $form->createView()
        ]);
    }

    /**
     * @Route("/", name="app_homepage_locale")
     */
    public function localeAction(Request $request)
    {
        $locale = $request->getLocale();
        return $this->redirectToRoute('app_homepage', [
            '_locale' => $locale
        ]);
    }
}