<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 16/10/2016
 * Time: 17:51
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as FormConstraint;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BilletRepository")
 * @ORM\Table(name="billet")
 */
class Billet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(min="2", minMessage="billets.nom.length")
     * @Assert\NotBlank(message="billets.nom.not_blank")
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Commande", inversedBy="billets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tarif")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tarif;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(min="2",minMessage="billets.prenom.length")
     * @Assert\NotBlank(message="billets.prenom.not_blank")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="billets.pays.not_blank")
     * @Assert\Country(message="billets.pays.country")
     */
    private $pays;

    /**
     * @ORM\Column(type="boolean")
     */
    private $tarifReduit = false;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="billets.date_naissance.not_blank")
     * @Assert\Date(message="billets.date_naissance.date")
     * @FormConstraint\BirthDate()
     */
    private $dateNaissance;

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @param mixed $pays
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param mixed $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }


    /**
     * @return Commande[]
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * @param mixed $commande
     */
    public function setCommande($commande)
    {
        $this->commande = $commande;
    }

    /**
     * @return mixed
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * @param mixed $tarif
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;
    }

    /**
     * @return mixed
     */
    public function isTarifReduit()
    {
        return $this->tarifReduit;
    }

    /**
     * @param mixed $tarifReduit
     */
    public function setTarifReduit($tarifReduit)
    {
        $this->tarifReduit = $tarifReduit;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


}
