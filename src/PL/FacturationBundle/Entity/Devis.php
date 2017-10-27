<?php

namespace PL\FacturationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Devis
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PL\FacturationBundle\Entity\DevisRepository")
 */
class Devis
{
  /**
   * @ORM\ManyToOne(targetEntity="PL\UserBundle\Entity\User")
   * @ORM\JoinColumn(nullable=false)
   */
   private $user;

  /**
   * @ORM\ManyToOne(targetEntity="PL\FacturationBundle\Entity\Carnet",cascade={"persist"})
   * @ORM\ JoinColumn(nullable=false)
   */
   private $carnet;


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
   // Par défaut, la date du devis est la date d'aujourd'hui
   $this->datDev = new \Datetime();
   // Par défaut le devis n'est pas archivé
   $this->arcDev = false;

 }




    /**
     * @var integer
     *
     * @ORM\Column(name="totDev", type="float")
     */
    private $totDev;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datDev", type="datetime")
     */
    private $datDev;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dpdDev", type="datetime", nullable=true)
     */
    private $dpdDev;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="darDev", type="datetime", nullable=true)
     */
    private $darDev;

    /**
     * @var boolean
     *
     * @ORM\Column(name="arcDev", type="boolean")
     */
    private $arcDev;

    /**
     * @var string
     *
     * @ORM\Column(name="drtDev", type="string", length=10)
     */
    private $drtDev;

    /**
     * @var string
     *
     * @ORM\Column(name="obsDev", type="string", length=255, nullable=true)
     */
    private $obsDev;

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
     * Set totDev
     *
     * @param integer $totDev
     * @return Devis
     */
    public function setTotDev($totDev)
    {
        $this->totDev = $totDev;

        return $this;
    }

    /**
     * Get totDev
     *
     * @return integer
     */
    public function getTotDev()
    {
        return $this->totDev;
    }

    /**
     * Set datDev
     *
     * @param \DateTime $datDev
     * @return Devis
     */
    public function setDatDev($datDev)
    {
        $this->datDev = $datDev;

        return $this;
    }

    /**
     * Get datDev
     *
     * @return \DateTime
     */
    public function getDatDev()
    {
        return $this->datDev;
    }

    /**
     * Set arcDev
     *
     * @param boolean $arcDev
     * @return Devis
     */
    public function setArcDev($arcDev)
    {
        $this->arcDev = $arcDev;

        return $this;
    }

    /**
     * Get arcDev
     *
     * @return boolean
     */
    public function getArcDev()
    {
        return $this->arcDev;
    }

    /**
     * Set carnet
     *
     * @param \PL\FacturationBundle\Entity\Carnet $carnet
     *
     * @return Devis
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
     * Set user
     *
     * @param \PL\UserBundle\Entity\User $user
     *
     * @return Devis
     */
    public function setUser(\PL\UserBundle\Entity\User $user)
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
     * Set dpdDev
     *
     * @param \DateTime $dpdDev
     *
     * @return Devis
     */
    public function setDpdDev($dpdDev)
    {
        $this->dpdDev = $dpdDev;

        return $this;
    }

    /**
     * Get dpdDev
     *
     * @return \DateTime
     */
    public function getDpdDev()
    {
        return $this->dpdDev;
    }

    /**
     * Set darDev
     *
     * @param \DateTime $darDev
     *
     * @return Devis
     */
    public function setDarDev($darDev)
    {
        $this->darDev = $darDev;

        return $this;
    }

    /**
     * Get darDev
     *
     * @return \DateTime
     */
    public function getDarDev()
    {
        return $this->darDev;
    }

    /**
     * Set drtDev
     *
     * @param string $drtDev
     *
     * @return Devis
     */
    public function setDrtDev($drtDev)
    {
        $this->drtDev = $drtDev;

        return $this;
    }

    /**
     * Get drtDev
     *
     * @return string
     */
    public function getDrtDev()
    {
        return $this->drtDev;
    }

    /**
     * Set obsDev
     *
     * @param string $obsDev
     *
     * @return Devis
     */
    public function setObsDev($obsDev)
    {
        $this->obsDev = $obsDev;

        return $this;
    }

    /**
     * Get obsDev
     *
     * @return string
     */
    public function getObsDev()
    {
        return $this->obsDev;
    }
}
