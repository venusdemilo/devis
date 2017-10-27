<?php

namespace PL\FacturationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Infoproduit
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Infoproduit
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
     * @var string
     *
     * @ORM\Column(name="libInf", type="text")
     */
    private $libInf;

    /**
     * @var string
     *
     * @ORM\Column(name="lbcInf", type="string", length=255)
     */
    private $lbcInf;

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
     * Set libInf
     *
     * @param string $libInf
     *
     * @return Infoproduit
     */
    public function setLibInf($libInf)
    {
        $this->libInf = $libInf;

        return $this;
    }

    /**
     * Get libInf
     *
     * @return string
     */
    public function getLibInf()
    {
        return $this->libInf;
    }

    /**
     * Set lbcInf
     *
     * @param string $lbcInf
     *
     * @return Infoproduit
     */
    public function setLbcInf($lbcInf)
    {
        $this->lbcInf = $lbcInf;

        return $this;
    }

    /**
     * Get lbcInf
     *
     * @return string
     */
    public function getLbcInf()
    {
        return $this->lbcInf;
    }
}
