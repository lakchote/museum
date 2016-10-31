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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IndexController extends Controller
{
    /**
     * @Route("/{_locale}", name="app_homepage")
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
        ($request->getLocale() == 'fr') ? $locale = 'fr' : $locale = 'en';
        //Pour afficher l'erreur 404 dans la bonne langue
        $this->get('session')->set('_locale', $locale);
        return $this->redirectToRoute('app_homepage', [
            '_locale' => $locale
        ]);
    }

    /**
     * @Route("/set/{_locale}", name="app_user_setLocale")
     */
    public function forceLocaleAction(Request $request)
    {
        $this->get('session')->set('_locale', $request->getLocale());
        $referer = $request->headers->get('referer');
        if(empty($referer)) throw new NotFoundHttpException();
        ($request->getLocale() == 'fr') ? $referer = preg_replace('/en/', 'fr', $referer, 1) : $referer = preg_replace('/fr/', 'en', $referer, 1);
        return $this->redirect($referer);
    }

    /**
     * @Route("/{_locale}/cgv", name="app_cgv")
     */
    public function cgvAction()
    {
        return $this->render('cgv.html.twig');
    }
}