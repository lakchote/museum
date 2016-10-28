<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 23/10/2016
 * Time: 17:42
 */

namespace AppBundle\Service;

use AppBundle\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;

class SendMail
{
    private $mailer;
    private $templating;
    private $translator;

    public function __construct(\Swift_Mailer $mailer, \Symfony\Bundle\TwigBundle\TwigEngine $twig, Translator $translator)
    {
        $this->mailer = $mailer;
        $this->templating = $twig;
        $this->translator = $translator;
    }

    public function sendMailToUserWithCommande(Commande $commande, $locale)
    {
        $translation = $this->translator->trans('mail.title', array(), 'recapitulatif');
        $message = \Swift_Message::newInstance()
            ->setSubject($translation)
            ->setFrom('billetterie@louvre.fr')
            ->setTo($commande->getEmailVisiteur())
            ->setBody(
                $this->templating->render('mail_recapitulatif_commande.html.twig', [
                    'commande' => $commande,
                    '_locale' => $locale
                ]),
                'text/html'
            );

        $this->mailer->send($message);
    }
}