<?php

namespace PL\FacturationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statut
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PL\FacturationBundle\Entity\StatutRepository")
 */
class Statut
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
     * @ORM\Column(name="libSta", type="string", length=255)
     */
    private $libSta;


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
     * Set libSta
     *
     * @param string $libSta
     * @return Statut
     */
    public function setLibSta($libSta)
    {
        $this->libSta = $libSta;

        return $this;
    }

    /**
     * Get libSta
     *
     * @return string 
     */
    public function getLibSta()
    {
        return $this->libSta;
    }
}
