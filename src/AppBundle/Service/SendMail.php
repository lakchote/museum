<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 23/10/2016
 * Time: 17:42
 */

namespace AppBundle\Service;

use AppBundle\Entity\Commande;

class SendMail
{
    private $mailer;
    private $templating;

    public function __construct(\Swift_Mailer $mailer, \Symfony\Bundle\TwigBundle\TwigEngine $twig)
    {
        $this->mailer = $mailer;
        $this->templating = $twig;
    }

    public function sendMailToUserWithCommande(Commande $commande)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Récapitulatif de votre commande')
            ->setFrom('billetterie@louvre.fr')
            ->setTo($commande->getEmailVisiteur())
            ->setBody(
                $this->templating->render('mail_recapitulatif_commande.html.twig', [
                    'commande' => $commande
                ]),
                'text/html'
            );

        $this->mailer->send($message);
    }
}