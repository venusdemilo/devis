<?php

namespace PL\FacturationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compteur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PL\FacturationBundle\Entity\CompteurRepository")
 */
class Compteur
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
     * @var integer
     *
     * @ORM\Column(name="carCom", type="integer")
     */
    private $carCom;

    /**
     * @var integer
     *
     * @ORM\Column(name="farCom", type="integer")
     */
    private $farCom;

    /**
     * @var integer
     *
     * @ORM\Column(name="fecCom", type="integer")
     */
    private $fecCom;

    /**
     * @var integer
     *
     * @ORM\Column(name="darCom", type="integer")
     */
    private $darCom;

    /**
     * @var integer
     *
     * @ORM\Column(name="decCom", type="integer")
     */
    private $decCom;


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
     * Set carCom
     *
     * @param integer $carCom
     *
     * @return Compteur
     */
    public function setCarCom($carCom)
    {
        $this->carCom = $carCom;

        return $this;
    }

    /**
     * Get carCom
     *
     * @return integer
     */
    public function getCarCom()
    {
        return $this->carCom;
    }

    /**
     * Set farCom
     *
     * @param integer $farCom
     *
     * @return Compteur
     */
    public function setFarCom($farCom)
    {
        $this->farCom = $farCom;

        return $this;
    }

    /**
     * Get farCom
     *
     * @return integer
     */
    public function getFarCom()
    {
        return $this->farCom;
    }

    /**
     * Set fecCom
     *
     * @param integer $fecCom
     *
     * @return Compteur
     */
    public function setFecCom($fecCom)
    {
        $this->fecCom = $fecCom;

        return $this;
    }

    /**
     * Get fecCom
     *
     * @return integer
     */
    public function getFecCom()
    {
        return $this->fecCom;
    }

    /**
     * Set darCom
     *
     * @param integer $darCom
     *
     * @return Compteur
     */
    public function setDarCom($darCom)
    {
        $this->darCom = $darCom;

        return $this;
    }

    /**
     * Get darCom
     *
     * @return integer
     */
    public function getDarCom()
    {
        return $this->darCom;
    }

    /**
     * Set decCom
     *
     * @param integer $decCom
     *
     * @return Compteur
     */
    public function setDecCom($decCom)
    {
        $this->decCom = $decCom;

        return $this;
    }

    /**
     * Get decCom
     *
     * @return integer
     */
    public function getDecCom()
    {
        return $this->decCom;
    }
}

