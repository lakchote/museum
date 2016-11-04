<?php

namespace tests\AppBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Entity\Billet;

/**
 * Class BilletRepositoryTest
 * Cette classe est destinée à vérifier la méthode checkMaxCapacity($date) du repository "Billet"
 * Cette méthode est censée retrouver le nombre de billets vendus pour une date donnée parmi toutes les commandes SI elles ont été finalisées
 */
class BilletRepositoryTest extends KernelTestCase 
{
    private $em;
    
    public function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    public function testcheckMaxCapacity()
    {
        /** Nous avons dans notre fixture 5 commandes différentes avec comme date de visite '2017-03-03'
         * Chacune comporte un billet mais seulement 2 ont été finalisées, le nombre de billets comptabilisés pour ce jour doit donc être de 2
         */
        $date = '2017-03-03';
        $result = count($this->em->getRepository(Billet::class)->checkMaxCapacity($date));
        $this->assertEquals(2, $result);
    }
}