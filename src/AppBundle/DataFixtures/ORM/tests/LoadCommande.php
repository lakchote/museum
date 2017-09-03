<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Billet;
use AppBundle\Entity\Commande;

/**
 * Class LoadCommande
 * Met en place la configuration nécessaire pour exécuter les tests unitaires et fonctionnels
 */
class LoadCommande implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tarif_senior = $manager->getRepository('AppBundle:Tarif')->findOneBy([
            'nom' => 'senior'
        ]);

        $date = new \DateTime('2017-03-03');
        $dateNaissance = new \DateTime('-63years');
        /*
         * Alias 'c' pour 'commande'
         */
        $c_finishedAndEmailSent = new Commande();
        $c_finishedAndEmailSent->setFinished(true);
        $c_finishedAndEmailSent->setDateVisite($date);
        $c_finishedAndEmailSent->setEmailVisiteur('l.akchote@gmail.com');
        $c_finishedAndEmailSent->setTypeBillet('journee');
        $c_finishedAndEmailSent->setNbBillets('1');
        $c_finishedAndEmailSent->setEmailSent(true);
        $billet = new Billet();
        $billet->setDateNaissance($dateNaissance);
        $billet->setNom('Test');
        $billet->setPrenom('Test');
        $billet->setPays('France');
        $billet->setTarif($tarif_senior);
        $c_finishedAndEmailSent->addBillet($billet);

        $c_notFinished = new Commande();
        $c_notFinished->setFinished(false);
        $c_notFinished->setDateVisite($date);
        $c_notFinished->setEmailVisiteur('l.akchote@gmail.com');
        $c_notFinished->setTypeBillet('journee');
        $c_notFinished->setNbBillets('1');
        $c_notFinished->setPrixTotal('12');
        $billet = new Billet();
        $billet->setDateNaissance($dateNaissance);
        $billet->setNom('Test');
        $billet->setPrenom('Test');
        $billet->setPays('France');
        $billet->setTarif($tarif_senior);
        $c_notFinished->addBillet($billet);

        $c_demiJournee= new Commande();
        $c_demiJournee->setFinished(false);
        $c_demiJournee->setDateVisite($date);
        $c_demiJournee->setEmailVisiteur('l.akchote@gmail.com');
        $c_demiJournee->setTypeBillet('demi_journee');
        $c_demiJournee->setNbBillets('1');
        $c_demiJournee->setPrixTotal('12');
        $billet = new Billet();
        $billet->setDateNaissance($dateNaissance);
        $billet->setNom('Test');
        $billet->setPrenom('Test');
        $billet->setPays('France');
        $billet->setTarif($tarif_senior);
        $c_demiJournee->addBillet($billet);


        $c_totalPriceNull = new Commande();
        $c_totalPriceNull->setFinished(false);
        $c_totalPriceNull->setDateVisite($date);
        $c_totalPriceNull->setEmailVisiteur('l.akchote@gmail.com');
        $c_totalPriceNull->setTypeBillet('journee');
        $c_totalPriceNull->setNbBillets('1');
        $c_totalPriceNull->setPrixTotal(0);
        $billet = new Billet();
        $billet->setDateNaissance($dateNaissance);
        $billet->setNom('Test');
        $billet->setPrenom('Test');
        $billet->setPays('France');
        $billet->setTarif($tarif_senior);
        $c_totalPriceNull->addBillet($billet);


        $c_finishedEmailNotSent = new Commande();
        $c_finishedEmailNotSent ->setFinished(true);
        $c_finishedEmailNotSent ->setDateVisite($date);
        $c_finishedEmailNotSent ->setEmailVisiteur('l.akchote@gmail.com');
        $c_finishedEmailNotSent ->setTypeBillet('journee');
        $c_finishedEmailNotSent ->setNbBillets('1');
        $c_finishedEmailNotSent ->setEmailSent(false);
        $billet = new Billet();
        $billet->setDateNaissance($dateNaissance);
        $billet->setNom('Test');
        $billet->setPrenom('Test');
        $billet->setPays('France');
        $billet->setTarif($tarif_senior);
        $c_finishedEmailNotSent->addBillet($billet);

        $manager->persist($c_finishedAndEmailSent);
        $manager->persist($c_notFinished);
        $manager->persist($c_demiJournee);
        $manager->persist($c_totalPriceNull);
        $manager->persist($c_finishedEmailNotSent);
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
