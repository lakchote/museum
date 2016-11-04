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

    //La commande ne doit pas être terminée
    public function testIsNotFinished()
    {
        $client = static::createClient();
        //Commande déjà terminée
        $crawler = $client->request('GET', '/fr/commande/recapitulatif/1');
        $this->assertContains('404 Not Found', $client->getResponse()->getContent());
        //Commande non terminée
        $crawler = $client->request('GET', '/fr/commande/recapitulatif/2');
        $this->assertContains('Récapitulatif de votre commande', $client->getResponse()->getContent());
    }

    //La commande ne doit pas être terminée et le prix total ne doit pas être nul
    public function testIsNotFinishedAndPriceNotNull()
    {
        $client = static::createClient();
        //Commande non terminée avec un prix total de 10 €
        $crawler = $client->request('GET', '/fr/paiement/2');
        $this->assertContains('Finalisation de la commande', $client->getResponse()->getContent());
        //Commande non terminée avec un prix nul
        $crawler = $client->request('GET', '/fr/paiement/4');
        $this->assertContains('404 Not Found', $client->getResponse()->getContent());
        //Commande terminée
        $crawler = $client->request('GET', '/fr/paiement/1');
        $this->assertContains('404 Not Found', $client->getResponse()->getContent());
    }

    //La commande doit être terminée et l'email pas encore envoyé
    public function testIsEmailNotSentAndIsFinished()
    {
        $client = static::createClient();
        //Commande terminée avec email déjà envoyé
        $crawler = $client->request('GET', '/fr/success/1');
        $this->assertContains('404 Not Found', $client->getResponse()->getContent());
        //Commande non terminée
        $crawler = $client->request('GET', '/fr/success/2');
        $this->assertContains('404 Not Found', $client->getResponse()->getContent());
        //Commande terminée avec email pas encore envoyé
        $crawler = $client->request('GET', '/fr/success/5');
        $this->assertContains('Commande terminée', $client->getResponse()->getContent());
    }
}