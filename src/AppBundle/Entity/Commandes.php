<?php
/**
 * Created by PhpStorm.
 * User: BRANDON HEAT
 * Date: 16/10/2016
 * Time: 17:23
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="commandes")
 */
class Commandes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Billets", mappedBy="commande")
     */
    private $billets;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFinished = false;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(
     *     message="Vous devez spécifier la date de votre visite au musée."
     * )
     */
    private $date_visite;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(
     *     message="Vous devez choisir un type de billet (Billet Journée OU Billet Demi-journée)"
     * )
     */
    private $type_billet;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(
     *     message="Vous devez saisir la quantité de billets souhaitée."
     * )
     * @Assert\Range(
     *     min=1,
     *     max=100,
     *     minMessage="Vous devez commander au moins un billet.",
     *     maxMessage="La quantité de billets demandée ne peut excéder 100"
     * )
     */
    private $nb_billets;

    /**
     * @ORM\Column(type="string")
     * @Assert\Email(
     *     message="L'email {{ value }} n'est pas une adresse email valide.",
     *     checkMX=true
     * )
     * @Assert\NotBlank(
     *     message="Vous devez renseigner votre adresse mail."
     * )
     */
    private $email_visiteur;

    public function __construct()
    {
        $this->billets = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getDateVisite()
    {
        return $this->date_visite;
    }

    /**
     * @param mixed $date_visite
     */
    public function setDateVisite($date_visite)
    {
        $this->date_visite = $date_visite;
    }

    /**
     * @return mixed
     */
    public function getTypeBillet()
    {
        return $this->type_billet;
    }

    /**
     * @param mixed $type_billet
     */
    public function setTypeBillet($type_billet)
    {
        $this->type_billet = $type_billet;
    }

    /**
     * @return mixed
     */
    public function getNbBillets()
    {
        return $this->nb_billets;
    }

    /**
     * @param mixed $nb_billets
     */
    public function setNbBillets($nb_billets)
    {
        $this->nb_billets = $nb_billets;
    }

    /**
     * @return mixed
     */
    public function getEmailVisiteur()
    {
        return $this->email_visiteur;
    }

    /**
     * @param mixed $email_visiteur
     */
    public function setEmailVisiteur($email_visiteur)
    {
        $this->email_visiteur = $email_visiteur;
    }

    /**
     * @return Billets[]|ArrayCollection
     */
    public function getBillets()
    {
        return $this->billets;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIsFinished()
    {
        return $this->isFinished;
    }

    /**
     * @param mixed $isFinished
     */
    public function setIsFinished($isFinished)
    {
        $this->isFinished = $isFinished;
    }

    public function __toString()
    {
        return (string)$this->getId();
    }
}