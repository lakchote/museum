<?php

namespace tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class CommandeControllerTest
 * Cette classe est destinée à vérifier que les ParamConverter des routes du contrôleur "CommandeController" fonctionnent correctement
 * Penser à lire le fichier README.md avant d'exécuter les tests
 */
class CommandeControllerTest extends WebTestCase
{
    public function testIsNotFinished()
    {
        $client = static::createClient();
        //Commande déjà terminée
        $crawler = $client->request('GET', '/fr/commande/recapitulatif/1');
        $this->assertContains('404', $client->getResponse()->getContent());
        //Commande non terminée
        $crawler = $client->request('GET', '/fr/commande/recapitulatif/2');
        $this->assertContains('Récapitulatif de votre commande', $client->getResponse()->getContent());
    }

    public function testIsNotFinishedAndPriceNotNull()
    {
        $client = static::createClient();
        //Commande non terminée avec un prix total de 10 €
        $crawler = $client->request('GET', '/fr/paiement/2');
        $this->assertContains('Finalisation de la commande', $client->getResponse()->getContent());
        //Commande non terminée avec un prix nul
        $crawler = $client->request('GET', 'fr/paiement/3');
        $this->assertContains('404', $client->getResponse()->getContent());
        //Commande terminée
        $crawler = $client->request('GET', '/fr/paiement/1');
        $this->assertContains('404', $client->getResponse()->getContent());
    }

    public function testIsEmailNotSentAndIsFinished()
    {
        $client = static::createClient();
        //Commande terminée avec email déjà envoyé
        $crawler = $client->request('GET', '/fr/success/1');
        $this->assertContains('404', $client->getResponse()->getContent());
        //Commande non terminée
        $crawler = $client->request('GET', '/fr/success/2');
        $this->assertContains('404', $client->getResponse()->getContent());
        //Commande terminée avec email pas encore envoyé
        $crawler = $client->request('GET', '/fr/success/4');
        $this->assertContains('Commande', $client->getResponse()->getContent());
    }
}