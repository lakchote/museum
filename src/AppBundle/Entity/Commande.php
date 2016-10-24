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
use AppBundle\Validator\Constraints as FormConstraint;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommandeRepository")
 * @ORM\Table(name="commande")
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Billet", mappedBy="commande", cascade={"persist", "remove"})
     * @Assert\Valid()
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
     * @FormConstraint\NotPastDay()
     * @FormConstraint\NotHoliday()
     * @FormConstraint\NotSunday()
     * @FormConstraint\NotTuesday()
     * @FormConstraint\NotMaxCapacity()
     */
    private $dateVisite;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(
     *     message="Vous devez choisir un type de billet (Billet Journée OU Billet Demi-journée)"
     * )
     */
    private $typeBillet;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(
     *     message="Vous devez saisir la quantité de billets souhaitée."
     * )
     * @Assert\Range(
     *     min=1,
     *     max=100,
     *     minMessage="Vous devez commander au moins un billet.",
     *     maxMessage="La quantité de billets demandée ne peut excéder 100."
     * )
     */
    private $nbBillets;

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
    private $emailVisiteur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prixTotal;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isEmailSent = false;

    public function __construct()
    {
        $this->billets = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getDateVisite()
    {
        return $this->dateVisite;
    }

    /**
     * @param mixed $dateVisite
     */
    public function setDateVisite($dateVisite)
    {
        $this->dateVisite = $dateVisite;
    }

    /**
     * @return string
     */
    public function getTypeBillet()
    {
        return $this->typeBillet;
    }

    /**
     * @param string $typeBillet
     */
    public function setTypeBillet($typeBillet)
    {
        $this->typeBillet = $typeBillet;
    }

    /**
     * @return mixed
     */
    public function getNbBillets()
    {
        return $this->nbBillets;
    }

    /**
     * @param mixed $nbBillets
     */
    public function setNbBillets($nbBillets)
    {
        $this->nbBillets = $nbBillets;
    }

    /**
     * @return string
     */
    public function getEmailVisiteur()
    {
        return $this->emailVisiteur;
    }

    /**
     * @param string $emailVisiteur
     */
    public function setEmailVisiteur($emailVisiteur)
    {
        $this->emailVisiteur = $emailVisiteur;
    }

    /**
     * @return Billet[]|ArrayCollection
     */
    public function getBillets()
    {
        return $this->billets;
    }

    /**
     * @param mixed Billet
     * @return Commande
     */
    public function addBillet($billet)
    {
        $this->billets->add($billet);
        $billet->setCommande($this);
    }

    /**
     * @return boolean
     */
    public function getIsFinished()
    {
        return $this->isFinished;
    }

    /**
     * @param boolean $isFinished
     */
    public function setIsFinished($isFinished)
    {
        $this->isFinished = $isFinished;
    }

    /**
     * @return integer
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }

    /**
     * @param integer $prixTotal
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;
    }

    /**
     * @return boolean
     */
    public function getIsEmailSent()
    {
        return $this->isEmailSent;
    }

    /**
     * @param boolean $isEmailSent
     */
    public function setIsEmailSent($isEmailSent)
    {
        $this->isEmailSent = $isEmailSent;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}