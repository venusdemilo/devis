<?php

namespace PL\FacturationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Carnet
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PL\FacturationBundle\Entity\CarnetRepository")
 * @ORM\HasLifecycleCallbacks()
 */


class Carnet
{


    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;




    /**
     * @var boolean
     *
     * @ORM\Column(name="staCar", type="boolean")
     */
    private $staCar;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tieCar", type="boolean")
     */
    private $tieCar;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCar", type="string", length=255)
     */
    private $nomCar;

    /**
     * @var string
     *
     * @ORM\Column(name="prnCar", type="string", length=255)
     */
    private $prnCar;

    /**
    * @var string
    *
    * @ORM\Column(name="rueCar", type="string", length=255, nullable=true)
    */
   private $rueCar;

   /**
   * @var string
   *
   * @ORM\Column(name="cdeCar", type="string", length=255, nullable=true)
   */
  private $cdeCar;

  /**
  * @var string
  *
  * @ORM\Column(name="vilCar", type="string", length=255, nullable=true)
  */
 private $vilCar;

 /**
 * @var string
 *
 * @ORM\Column(name="telCar", type="string", length=255, nullable=true)
 */
private $telCar;

/**
* @var string
*
* @ORM\Column(name="melCar", type="string", length=255, nullable=true)
*/
private $melCar;

/**
 * @var \DateTime
 *
 * @ORM\Column(name="datCar", type="datetime")
 */
private $datCar;

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
     * Set nomCar
     *
     * @param string $nomCar
     * @return Carnet
     */
    public function setNomCar($nomCar)
    {
        $this->nomCar = $nomCar;

        return $this;
    }

    /**
     * Get nomCar
     *
     * @return string
     */
    public function getNomCar()
    {
        return $this->nomCar;
    }

    /**
     * Set prnCar
     *
     * @param string $prnCar
     * @return Carnet
     */
    public function setPrnCar($prnCar)
    {
        $this->prnCar = $prnCar;

        return $this;
    }

    /**
     * Get prnCar
     *
     * @return string
     */
    public function getPrnCar()
    {
        return $this->prnCar;
    }


    /**
     * Constructor
     */
    public function __construct()
    {

        $this->datCar = new \Datetime();
    }







    /**
     * Set rueCar
     *
     * @param string $rueCar
     *
     * @return Carnet
     */
    public function setRueCar($rueCar)
    {
        $this->rueCar = $rueCar;

        return $this;
    }

    /**
     * Get rueCar
     *
     * @return string
     */
    public function getRueCar()
    {
        return $this->rueCar;
    }

    /**
     * Set cdeCar
     *
     * @param string $cdeCar
     *
     * @return Carnet
     */
    public function setCdeCar($cdeCar)
    {
        $this->cdeCar = $cdeCar;

        return $this;
    }

    /**
     * Get cdeCar
     *
     * @return string
     */
    public function getCdeCar()
    {
        return $this->cdeCar;
    }

    /**
     * Set vilCar
     *
     * @param string $vilCar
     *
     * @return Carnet
     */
    public function setVilCar($vilCar)
    {
        $this->vilCar = $vilCar;

        return $this;
    }

    /**
     * Get vilCar
     *
     * @return string
     */
    public function getVilCar()
    {
        return $this->vilCar;
    }

    /**
     * Set telCar
     *
     * @param string $telCar
     *
     * @return Carnet
     */
    public function setTelCar($telCar)
    {
        $this->telCar = $telCar;

        return $this;
    }

    /**
     * Get telCar
     *
     * @return string
     */
    public function getTelCar()
    {
        return $this->telCar;
    }

    /**
     * Set melCar
     *
     * @param string $melCar
     *
     * @return Carnet
     */
    public function setMelCar($melCar)
    {
        $this->melCar = $melCar;

        return $this;
    }

    /**
     * Get melCar
     *
     * @return string
     */
    public function getMelCar()
    {
        return $this->melCar;
    }

    /**
     * Set datCar
     *
     * @param \DateTime $datCar
     *
     * @return Carnet
     */
    public function setDatCar($datCar)
    {
        $this->datCar = $datCar;

        return $this;
    }

    /**
     * Get datCar
     *
     * @return \DateTime
     */
    public function getDatCar()
    {
        return $this->datCar;
    }

    /**
     * Set staCar
     *
     * @param boolean $staCar
     *
     * @return Carnet
     */
    public function setStaCar($staCar)
    {
        $this->staCar = $staCar;

        return $this;
    }

    /**
     * Get staCar
     *
     * @return boolean
     */
    public function getStaCar()
    {
        return $this->staCar;
    }





    /**
     * Set nbDevis
     *
     * @param integer $nbDevis
     *
     * @return Carnet
     */
    public function setNbDevis($nbDevis)
    {
        $this->nbDevis = $nbDevis;

        return $this;
    }

    /**
     * Get nbDevis
     *
     * @return integer
     */
    public function getNbDevis()
    {
        return $this->nbDevis;
    }

    /**
     * Set tieCar
     *
     * @param boolean $tieCar
     *
     * @return Carnet
     */
    public function setTieCar($tieCar)
    {
        $this->tieCar = $tieCar;

        return $this;
    }

    /**
     * Get tieCar
     *
     * @return boolean
     */
    public function getTieCar()
    {
        return $this->tieCar;
    }
}
