<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 29/10/2016
 * Time: 23:17
 */

namespace tests\AppBundle\Service;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Entity\Commande;

/**
 * Class TotalPriceTest
 * Cette classe vérifie que le service "total_price_for_commande" attribue selon le type de billets le prix correspondant (tarif plein ou réduit de moitié)
 */
class TotalPriceTest extends KernelTestCase
{
    private $em;
    private $totalPrice;

    protected function setUp() {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        $this->totalPrice = static::$kernel->getContainer()->get('total_price_for_commande');
    }

    public function testCommandeJournee()
    {
        //Commande avec un type de billets "Journée" (tarif plein) et un billet comportant le tarif sénior (12€)
        $commande_typeJournee = $this->em->getRepository(Commande::class)->find(2);
        $result = $this->totalPrice->calculateTotalPrice($commande_typeJournee);
        $this->assertEquals(12, $result);
    }

    public function testCommandeDemiJournee()
    {
        //Commande avec un type de billets "Demi-journée" (tarif réduit de moitié) et un billet comportant le tarif sénior (12€)
        $commande_typeDemiJournee = $this->em->getRepository(Commande::class)->find(3);
        $result = $this->totalPrice->calculateTotalPrice($commande_typeDemiJournee);
        $this->assertEquals(6, $result);
    }
}