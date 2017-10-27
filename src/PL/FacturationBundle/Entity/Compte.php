<?php

namespace PL\FacturationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compte
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PL\FacturationBundle\Entity\CompteRepository")
 */
class Compte
{
/**
* @ORM\OneToOne(targetEntity="PL\FacturationBundle\Entity\Carnet")
* @ORM\JoinColumn(nullable=true)
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

    /**
     * @var string
     *
     * @ORM\Column(name="libCom", type="string", length=255)
     */
    private $libCom;

    /**
     * @var string
     *
     * @ORM\Column(name="typCom", type="string", length=255)
     */
    private $typCom;


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
     * Set libCom
     *
     * @param string $libCom
     *
     * @return Compte
     */
    public function setLibCom($libCom)
    {
        $this->libCom = $libCom;

        return $this;
    }

    /**
     * Get libCom
     *
     * @return string
     */
    public function getLibCom()
    {
        return $this->libCom;
    }

    /**
     * Set typCom
     *
     * @param string $typCom
     *
     * @return Compte
     */
    public function setTypCom($typCom)
    {
        $this->typCom = $typCom;

        return $this;
    }

    /**
     * Get typCom
     *
     * @return string
     */
    public function getTypCom()
    {
        return $this->typCom;
    }

    /**
     * Set carnet
     *
     * @param \PL\FacturationBundle\Entity\Carnet $carnet
     *
     * @return Compte
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
}
