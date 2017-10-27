<?php

namespace PL\FacturationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PL\FacturationBundle\Entity\FactureRepository")
 */
class Facture
{

  /**
   * @ORM\ManyToOne(targetEntity="PL\FacturationBundle\Entity\Carnet")
   * @ORM\ JoinColumn(nullable=false)
   */
   private $carnet;

   /**
    * @ORM\OneToOne(targetEntity="PL\FacturationBundle\Entity\Devis")
    * @ORM\ JoinColumn(nullable=false)
    */
    private $devis;

    /**
     * @ORM\ManyToOne(targetEntity="PL\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
     private $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    public function __construct()
 {
   // Par défaut, la date de la facture est la date d'aujourd'hui
   $this->datFac = new \Datetime();
   // Par défaut la facture n'est pas archivé
   $this->arcFac = false;
   //Par défaut la facture n'est pas validée
   $this->vldFac = false;
   //Par défaut la facture n'est pas en rappel
   $this->rapFac = false;
   //Par défaut la facture n'est pas en recouvrement
   $this->recFac = false;
   //Par défaut la facture n'est pas envoyée en 1/3 payant
   $this->tieFac = false;

 }

 /**
  * @var \DateTime
  *
  * @ORM\Column(name="dpfFac", type="datetime", nullable=false)
  */
 private $dpfFac;

    /**
     * @var float
     *
     * @ORM\Column(name="totFac", type="float")
     */
    private $totFac;

    /**
     * @var float
     *
     * @ORM\Column(name="solFac", type="float")
     */
    private $solFac=0;

    /**
     * @var float
     *
     * @ORM\Column(name="remFac", type="float")
     */
    private $remFac=0;

    /**
     * @var float
     *
     * @ORM\Column(name="paiFac", type="float")
     */
    private $paiFac=0;

    /**
     * @var text
     *
     * @ORM\Column(name="obsFac", type="text", nullable=true)
     */
    private $obsFac;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datFac", type="datetime")
     */
    private $datFac;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="darFac", type="datetime", nullable=true)
     */
    private $darFac;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dtrFac", type="datetime", nullable=true)
     */
    private $dtrFac;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="drpFac", type="datetime", nullable=true)
     */
    private $drpFac;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="drcFac", type="datetime", nullable=true)
     */
    private $drcFac;

    /**
     * @var boolean
     *
     * @ORM\Column(name="arcFac", type="boolean")
     */
    private $arcFac;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vldFac", type="boolean")
     */
    private $vldFac;

    /**
     * @var boolean
     *
     * @ORM\Column(name="rapFac", type="boolean")
     */
    private $rapFac;

    /**
     * @var boolean
     *
     * @ORM\Column(name="recFac", type="boolean")
     */
    private $recFac;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tieFac", type="boolean")
     */
    private $tieFac;

    /**
     * @var string
     *
     * @ORM\Column(name="drtFac", type="string", length=10)
     */
    private $drtFac;




    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set totFac
     *
     * @param float $totFac
     *
     * @return Facture
     */
    public function setTotFac($totFac)
    {
        $this->totFac = $totFac;

        return $this;
    }

    /**
     * Get totFac
     *
     * @return float
     */
    public function getTotFac()
    {
        return $this->totFac;
    }

    /**
     * Set datFac
     *
     * @param \DateTime $datFac
     *
     * @return Facture
     */
    public function setDatFac($datFac)
    {
        $this->datFac = $datFac;

        return $this;
    }

    /**
     * Get datFac
     *
     * @return \DateTime
     */
    public function getDatFac()
    {
        return $this->datFac;
    }

    /**
     * Set arcFac
     *
     * @param boolean $arcFac
     *
     * @return Facture
     */
    public function setArcFac($arcFac)
    {
        $this->arcFac = $arcFac;

        return $this;
    }

    /**
     * Get arcFac
     *
     * @return boolean
     */
    public function getArcFac()
    {
        return $this->arcFac;
    }

    /**
     * Set vldFac
     *
     * @param boolean $vldFac
     *
     * @return Facture
     */
    public function setVldFac($vldFac)
    {
        $this->vldFac = $vldFac;

        return $this;
    }

    /**
     * Get vldFac
     *
     * @return boolean
     */
    public function getVldFac()
    {
        return $this->vldFac;
    }

    /**
     * Set carnet
     *
     * @param \PL\FacturationBundle\Entity\Carnet $carnet
     *
     * @return Facture
     */
    public function setCarnet(\PL\FacturationBundle\Entity\Carnet $carnet)
    {
        $this->carnet = $carnet;

        return $this;
    }

    /**
     * Get carnet
     *
     * @return \PL\FacturationBundle\Entity\Carnet
     */
    public function getCarnet()
    {
        return $this->carnet;
    }

    /**
     * Set devis
     *
     * @param \PL\FacturationBundle\Entity\Devis $devis
     *
     * @return Facture
     */
    public function setDevis(\PL\FacturationBundle\Entity\Devis $devis)
    {
        $this->devis = $devis;

        return $this;
    }

    /**
     * Get devis
     *
     * @return \PL\FacturationBundle\Entity\Devis
     */
    public function getDevis()
    {
        return $this->devis;
    }

    /**
     * Set dpfFac
     *
     * @param \DateTime $dpfFac
     *
     * @return Facture
     */
    public function setDpfFac($dpfFac)
    {
        $this->dpfFac = $dpfFac;

        return $this;
    }

    /**
     * Get dpfFac
     *
     * @return \DateTime
     */
    public function getDpfFac()
    {
        return $this->dpfFac;
    }

    /**
     * Set user
     *
     * @param \PL\UserBundle\Entity\User $user
     *
     * @return Facture
     */
    public function setUser(\PL\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \PL\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set solFac
     *
     * @param float $solFac
     *
     * @return Facture
     */
    public function setSolFac($solFac)
    {
        $this->solFac = $solFac;

        return $this;
    }

    /**
     * Get solFac
     *
     * @return float
     */
    public function getSolFac()
    {
        return $this->solFac;
    }



    /**
     * Set darFac
     *
     * @param \DateTime $darFac
     *
     * @return Facture
     */
    public function setDarFac($darFac)
    {
        $this->darFac = $darFac;

        return $this;
    }

    /**
     * Get darFac
     *
     * @return \DateTime
     */
    public function getDarFac()
    {
        return $this->darFac;
    }

    /**
     * Set remFac
     *
     * @param float $remFac
     *
     * @return Facture
     */
    public function setRemFac($remFac)
    {
        $this->remFac = $remFac;

        return $this;
    }

    /**
     * Get remFac
     *
     * @return float
     */
    public function getRemFac()
    {
        return $this->remFac;
    }

    /**
     * Set paiFac
     *
     * @param float $paiFac
     *
     * @return Facture
     */
    public function setPaiFac($paiFac)
    {
        $this->paiFac = $paiFac;

        return $this;
    }

    /**
     * Get paiFac
     *
     * @return float
     */
    public function getPaiFac()
    {
        return $this->paiFac;
    }

    /**
     * Set rapFac
     *
     * @param boolean $rapFac
     *
     * @return Facture
     */
    public function setRapFac($rapFac)
    {
        $this->rapFac = $rapFac;

        return $this;
    }

    /**
     * Get rapFac
     *
     * @return boolean
     */
    public function getRapFac()
    {
        return $this->rapFac;
    }

    /**
     * Set recFac
     *
     * @param boolean $recFac
     *
     * @return Facture
     */
    public function setRecFac($recFac)
    {
        $this->recFac = $recFac;

        return $this;
    }

    /**
     * Get recFac
     *
     * @return boolean
     */
    public function getRecFac()
    {
        return $this->recFac;
    }

    /**
     * Set dtrFac
     *
     * @param \DateTime $dtrFac
     *
     * @return Facture
     */
    public function setDtrFac($dtrFac)
    {
        $this->dtrFac = $dtrFac;

        return $this;
    }

    /**
     * Get dtrFac
     *
     * @return \DateTime
     */
    public function getDtrFac()
    {
        return $this->dtrFac;
    }

    /**
     * Set drpFac
     *
     * @param \DateTime $drpFac
     *
     * @return Facture
     */
    public function setDrpFac($drpFac)
    {
        $this->drpFac = $drpFac;

        return $this;
    }

    /**
     * Get drpFac
     *
     * @return \DateTime
     */
    public function getDrpFac()
    {
        return $this->drpFac;
    }

    /**
     * Set drcFac
     *
     * @param \DateTime $drcFac
     *
     * @return Facture
     */
    public function setDrcFac($drcFac)
    {
        $this->drcFac = $drcFac;

        return $this;
    }

    /**
     * Get drcFac
     *
     * @return \DateTime
     */
    public function getDrcFac()
    {
        return $this->drcFac;
    }

    /**
     * Set tieFac
     *
     * @param boolean $tieFac
     *
     * @return Facture
     */
    public function setTieFac($tieFac)
    {
        $this->tieFac = $tieFac;

        return $this;
    }

    /**
     * Get tieFac
     *
     * @return boolean
     */
    public function getTieFac()
    {
        return $this->tieFac;
    }

    /**
     * Set obsFac
     *
     * @param string $obsFac
     *
     * @return Facture
     */
    public function setObsFac($obsFac)
    {
        $this->obsFac = $obsFac;

        return $this;
    }

    /**
     * Get obsFac
     *
     * @return string
     */
    public function getObsFac()
    {
        return $this->obsFac;
    }

    /**
     * Set drtFac
     *
     * @param string $drtFac
     *
     * @return Facture
     */
    public function setDrtFac($drtFac)
    {
        $this->drtFac = $drtFac;

        return $this;
    }

    /**
     * Get drtFac
     *
     * @return string
     */
    public function getDrtFac()
    {
        return $this->drtFac;
    }
}
