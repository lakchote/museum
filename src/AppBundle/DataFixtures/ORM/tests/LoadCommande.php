<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 19/10/2016
 * Time: 17:28
 */

namespace AppBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Tarif;
use AppBundle\Entity\Billet;
use AppBundle\Entity\Commande;

/**
 * Class LoadCommande
 * Met en place la configuration nécessaire pour exécuter les tests unitaires et fonctionnels
 */
class LoadCommande implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tarif_gratuit = new Tarif();
        $tarif_gratuit->setNom('gratuit');
        $tarif_gratuit->setAgeMin(0);
        $tarif_gratuit->setAgeMax(4);
        $tarif_gratuit->setPrix(0);

        $tarif_enfant = new Tarif();
        $tarif_enfant->setNom('enfant');
        $tarif_enfant->setAgeMin(4);
        $tarif_enfant->setAgeMax(12);
        $tarif_enfant->setPrix(8);

        $tarif_normal = new Tarif();
        $tarif_normal->setNom('normal');
        $tarif_normal->setAgeMin(12);
        $tarif_normal->setAgeMax(60);
        $tarif_normal->setPrix(16);

        $tarif_senior = new Tarif();
        $tarif_senior->setNom('senior');
        $tarif_senior->setAgeMin(60);
        $tarif_senior->setAgeMax(999);
        $tarif_senior->setPrix(12);

        $tarif_reduit = new Tarif();
        $tarif_reduit->setNom('reduit');
        $tarif_reduit->setPrix(10);

        $manager->persist($tarif_gratuit);
        $manager->persist($tarif_enfant);
        $manager->persist($tarif_normal);
        $manager->persist($tarif_senior);
        $manager->persist($tarif_reduit);
        $manager->flush();

        $date = new \DateTime('2017-03-03');
        $dateNaissance = new \DateTime('-63years');
        /*
         * Alias 'c' pour 'commande'
         */
        $c_finishedAndEmailSent = new Commande();
        $c_finishedAndEmailSent->setIsFinished(true);
        $c_finishedAndEmailSent->setDateVisite($date);
        $c_finishedAndEmailSent->setEmailVisiteur('exemple@gmail.com');
        $c_finishedAndEmailSent->setTypeBillet('journee');
        $c_finishedAndEmailSent->setNbBillets('1');
        $c_finishedAndEmailSent->setIsEmailSent(true);
        $billet = new Billet();
        $billet->setDateNaissance($dateNaissance);
        $billet->setNom('Test');
        $billet->setPrenom('Test');
        $billet->setPays('France');
        $billet->setTarif($tarif_senior);
        $c_finishedAndEmailSent->addBillet($billet);

        $c_notFinished = new Commande();
        $c_notFinished->setIsFinished(false);
        $c_notFinished->setDateVisite($date);
        $c_notFinished->setEmailVisiteur('exemple@gmail.com');
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
        $c_demiJournee->setIsFinished(false);
        $c_demiJournee->setDateVisite($date);
        $c_demiJournee->setEmailVisiteur('exemple@gmail.com');
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
        $c_totalPriceNull->setIsFinished(false);
        $c_totalPriceNull->setDateVisite($date);
        $c_totalPriceNull->setEmailVisiteur('exemple@gmail.com');
        $c_totalPriceNull->setTypeBillet('journee');
        $c_totalPriceNull->setNbBillets('1');
        $c_totalPriceNull->setPrixTotal(0);

        $c_finishedEmailNotSent = new Commande();
        $c_finishedEmailNotSent ->setIsFinished(true);
        $c_finishedEmailNotSent ->setDateVisite($date);
        $c_finishedEmailNotSent ->setEmailVisiteur('exemple@gmail.com');
        $c_finishedEmailNotSent ->setTypeBillet('journee');
        $c_finishedEmailNotSent ->setNbBillets('1');
        $c_finishedEmailNotSent ->setIsEmailSent(false);

        $manager->persist($c_finishedAndEmailSent);
        $manager->persist($c_notFinished);
        $manager->persist($c_demiJournee);
        $manager->persist($c_totalPriceNull);
        $manager->persist($c_finishedEmailNotSent);
        $manager->flush();
    }
}