<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Tarif;


class LoadTarif implements FixtureInterface, OrderedFixtureInterface
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
    }

    public function getOrder()
    {
        return 1;
    }
}
