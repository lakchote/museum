<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 16/10/2016
 * Time: 18:02
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tarifs")
 */
class Tarifs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $type_tarif;

    /**
     * @return mixed
     */
    public function getTypeTarif()
    {
        return $this->type_tarif;
    }

    /**
     * @param mixed $type_tarif
     */
    public function setTypeTarif($type_tarif)
    {
        $this->type_tarif = $type_tarif;
    }

}