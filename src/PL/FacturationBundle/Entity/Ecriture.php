<?php

namespace PL\FacturationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ecriture
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PL\FacturationBundle\Entity\EcritureRepository")
 */
class Ecriture
{
  public function __construct(){
  // Génération date écriture
  $this->datEcr = new \Datetime();
  }
  /**
   * @ORM\ManyToOne(targetEntity="PL\FacturationBundle\Entity\Facture")
   * @ORM\ JoinColumn(nullable=false)
   */
  private $facture;

  /**
   * @ORM\ManyToOne(targetEntity="PL\UserBundle\Entity\User")
   * @ORM\JoinColumn(nullable=true)
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

    /**
     * @var string
     *
     * @ORM\Column(name="libEcr", type="string", length=255)
     */
    private $libEcr;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datEcr", type="datetime")
     */
    private $datEcr;




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
     * Set libEcr
     *
     * @param string $libEcr
     *
     * @return Ecriture
     */
    public function setLibEcr($libEcr)
    {
        $this->libEcr = $libEcr;

        return $this;
    }

    /**
     * Get libEcr
     *
     * @return string
     */
    public function getLibEcr()
    {
        return $this->libEcr;
    }

    /**
     * Set datEcr
     *
     * @param \DateTime $datEcr
     *
     * @return Ecriture
     */
    public function setDatEcr($datEcr)
    {
        $this->datEcr = $datEcr;

        return $this;
    }

    /**
     * Get datEcr
     *
     * @return \DateTime
     */
    public function getDatEcr()
    {
        return $this->datEcr;
    }

    /**
     * Set facture
     *
     * @param \PL\FacturationBundle\Entity\Facture $facture
     *
     * @return Ecriture
     */
    public function setFacture(\PL\FacturationBundle\Entity\Facture $facture)
    {
        $this->facture = $facture;

        return $this;
    }

    /**
     * Get facture
     *
     * @return \PL\FacturationBundle\Entity\Facture
     */
    public function getFacture()
    {
        return $this->facture;
    }

    /**
     * Set user
     *
     * @param \PL\UserBundle\Entity\User $user
     *
     * @return Ecriture
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
     * Set drtEcr
     *
     * @param string $drtEcr
     *
     * @return Ecriture
     */
    public function setDrtEcr($drtEcr)
    {
        $this->drtEcr = $drtEcr;

        return $this;
    }

    /**
     * Get drtEcr
     *
     * @return string
     */
    public function getDrtEcr()
    {
        return $this->drtEcr;
    }
}
