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
     * @Assert\Length(min="3", minMessage="Le prénom ne peut faire moins de 3 caractères")
     * @Assert\NotBlank(message="Vous devez spécifier le nom.")
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
     * @Assert\Length(min="3",minMessage="Le prénom ne peut faire moins de 3 caractères")
     * @Assert\NotBlank(message="Vous devez spécifier le prénom.")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Vous devez spécifier le pays.")
     * @Assert\Country(message="Ceci n'est pas un pays valide")
     */
    private $pays;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isTarifReduit = false;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Vous devez spécifier la date de naissance.")
     * @Assert\Date(message="Ceci n'est pas un format de date de naissance valide.")
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
    public function getIsTarifReduit()
    {
        return $this->isTarifReduit;
    }

    /**
     * @param mixed $isTarifReduit
     */
    public function setIsTarifReduit($isTarifReduit)
    {
        $this->isTarifReduit = $isTarifReduit;
    }

}