<?php

namespace PL\FacturationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
// On rajoute ce use pour la contrainte :
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity
 * @UniqueEntity(fields="refProd", message="Un produit contenant la même référence existe déjà.")
 */


/**
 * Produit
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PL\FacturationBundle\Entity\ProduitRepository")
 */



class Produit
{
  /**
   * @ORM\ManyToOne(targetEntity="PL\UserBundle\Entity\User")
   * @ORM\JoinColumn(nullable=false)
   */
   private $user;

  /**
   * @ORM\ManyToOne(targetEntity="PL\FacturationBundle\Entity\Infoproduit")
   * @ORM\JoinColumn(nullable=true)
   */
   private $infoproduit;

    /**
     * @ORM\ManyToOne(targetEntity="PL\FacturationBundle\Entity\Famille", inversedBy="produits", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
     private $famille;


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
     * @ORM\Column(name="refProd", type="string", length=255, unique=false)
     */
    private $refProd;

    /**
     * @var string
     *
     * @ORM\Column(name="rffProd", type="string", length=255, nullable=true)
     */
    private $rffProd;

    /**
     * @var string
     *
     * @ORM\Column(name="libProd", type="string", length=255, nullable=true)
     */
    private $libProd;

    /**
     * @var string
     *
     * @ORM\Column(name="ttcProd", type="float", nullable=true)
     */
    private $ttcProd;

    /**
     * @var string
     *
     * @ORM\Column(name="vntProd", type="float", nullable=true)
     */
    private $vntProd;

    /**
     * @var string
     *
     * @ORM\Column(name="tvaProd", type="float", nullable=true)
     */
    private $tvaProd;

    /**
     * @var string
     *
     * @ORM\Column(name="marProd", type="float",nullable=true)
     */
    private $marProd;


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
     * Set refProd
     *
     * @param string $refProd
     * @return Produit
     */
    public function setRefProd($refProd)
    {
        $this->refProd = $refProd;

        return $this;
    }

    /**
     * Get refProd
     *
     * @return string
     */
    public function getRefProd()
    {
        return $this->refProd;
    }

    /**
     * Set rffProd
     *
     * @param string $rffProd
     * @return Produit
     */
    public function setRffProd($rffProd)
    {
        $this->rffProd = $rffProd;

        return $this;
    }

    /**
     * Get rffProd
     *
     * @return string
     */
    public function getRffProd()
    {
        return $this->rffProd;
    }

    /**
     * Set libProd
     *
     * @param string $libProd
     * @return Produit
     */
    public function setLibProd($libProd)
    {
        $this->libProd = $libProd;

        return $this;
    }

    /**
     * Get libProd
     *
     * @return string
     */
    public function getLibProd()
    {
        return $this->libProd;
    }

    /**
     * Set ttcProd
     *
     * @param string $ttcProd
     * @return Produit
     */
    public function setTtcProd($ttcProd)
    {
        $this->ttcProd = $ttcProd;

        return $this;
    }

    /**
     * Get ttcProd
     *
     * @return string
     */
    public function getTtcProd()
    {
        return $this->ttcProd;
    }

    /**
     * Set vntProd
     *
     * @param string $vntProd
     * @return Produit
     */
    public function setVntProd($vntProd)
    {
        $this->vntProd = $vntProd;

        return $this;
    }

    /**
     * Get vntProd
     *
     * @return string
     */
    public function getVntProd()
    {
        return $this->vntProd;
    }

    /**
     * Set tvaProd
     *
     * @param string $tvaProd
     * @return Produit
     */
    public function setTvaProd($tvaProd)
    {
        $this->tvaProd = $tvaProd;

        return $this;
    }

    /**
     * Get tvaProd
     *
     * @return string
     */
    public function getTvaProd()
    {
        return $this->tvaProd;
    }

    /**
     * Set marProd
     *
     * @param string $marProd
     * @return Produit
     */
    public function setMarProd($marProd)
    {
        $this->marProd = $marProd;

        return $this;
    }

    /**
     * Get marProd
     *
     * @return string
     */
    public function getMarProd()
    {
        return $this->marProd;
    }

    /**
     * Set famille
     *
     * @param \PL\Facturation\Entity\Famille $famille
     * @return Produit
     */
    public function setFamille(\PL\FacturationBundle\Entity\Famille $famille = null)
    {
        $this->famille = $famille;

        return $this;
    }

    /**
     * Get famille
     *
     * @return \PL\FacturationBundle\Entity\Famille
     */
    public function getFamille()
    {
        return $this->famille;
    }

    /**
     * Set infProd
     *
     * @param string $infProd
     *
     * @return Produit
     */
    public function setInfProd($infProd)
    {
        $this->infProd = $infProd;

        return $this;
    }

    /**
     * Get infProd
     *
     * @return string
     */
    public function getInfProd()
    {
        return $this->infProd;
    }

    /**
     * Set user
     *
     * @param \PL\UserBundle\Entity\User $user
     *
     * @return Produit
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
     * Set infoproduit
     *
     * @param \PL\FacturationBundle\Entity\Infoproduit $infoproduit
     *
     * @return Produit
     */
    public function setInfoproduit(\PL\FacturationBundle\Entity\Infoproduit $infoproduit = null)
    {
        $this->infoproduit = $infoproduit;

        return $this;
    }

    /**
     * Get infoproduit
     *
     * @return \PL\FacturationBundle\Entity\Infoproduit
     */
    public function getInfoproduit()
    {
        return $this->infoproduit;
    }
}
