<?php

namespace tests\AppBundle\Service;

use AppBundle\Entity\Tarif;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class TarifResolverTest
 * Cette classe est destinée à vérifier que la méthode getTarifForBillet() du service "tarif_resolver" fonctionne correctement
 */
class TarifResolverTest extends KernelTestCase
{
    private $tarifResolver;

    protected function setUp() {
        self::bootKernel();
        $this->tarifResolver = static::$kernel->getContainer()->get('tarif_resolver');
    }

    public function testGetTarifForBillet()
    {
        //On met en paramètre de la méthode une année supérieure à l'année en cours
        $anneeSuperieure = $this->tarifResolver->getTarifForBillet(new \DateTime('+1 year'));
        //On vérifie que la méthode a bien retourné false
        $this->assertFalse($anneeSuperieure);

        //On met en paramètre de la méthode une année inférieure à l'année en cours
        $anneeInferieure = $this->tarifResolver->getTarifForBillet(new \DateTime('-1 year'));
        //Puis on va tester pour l'année en cours
        $anneeEnCours = $this->tarifResolver->getTarifForBillet(new \DateTime());
        //On vérifie que la méthode a bien retourné une instance de l'entité Tarif dans les deux cas
        $this->assertInstanceOf(Tarif::class, $anneeInferieure);
        $this->assertInstanceOf(Tarif::class, $anneeEnCours);
    }
}