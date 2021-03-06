<?php

namespace PL\FacturationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProduitDevis
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PL\FacturationBundle\Entity\ProduitDevisRepository")
 */
class ProduitDevis
{

    /**
     * @ORM\ManyToOne(targetEntity="PL\FacturationBundle\Entity\Devis",cascade={"persist","remove"})
     * @ORM\ JoinColumn(nullable=false)
     */
     private $devis;

     /**
      * @ORM\ManyToOne(targetEntity="PL\FacturationBundle\Entity\Produit",cascade={"persist"})
      * @ORM\ JoinColumn(nullable=false)
      */
      private $produit;

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
     * @ORM\Column(name="quaPrD", type="integer")
     */
    private $quaPrD;


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
     * Set quaPrD
     *
     * @param integer $quaPrD
     * @return ProduitDevis
     */
    public function setQuaPrD($quaPrD)
    {
        $this->quaPrD = $quaPrD;

        return $this;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="libPrD", type="string", length=255)
     */
    private $libPrD;

    /**
     * @var string
     *
     * @ORM\Column(name="obsPrD", type="string", length=255, nullable=true)
     */
    private $obsPrD;

    /**
     * @var string
     *
     * @ORM\Column(name="refPrD", type="string", length=255)
     */
    private $refPrd;

    /**
     * @var string
     *
     * @ORM\Column(name="ttcPrD", type="float")
     */
    private $ttcPrD;



    /**
     * Get quaPrD
     *
     * @return integer
     */
    public function getQuaPrD()
    {
        return $this->quaPrD;
    }



    /**
     * Set devis
     *
     * @param \PL\FacturationBundle\Entity\Devis $devis
     * @return ProduitDevis
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
     * Set produit
     *
     * @param \PL\FacturationBundle\Entity\Produit $produit
     * @return ProduitDevis
     */
    public function setProduit(\PL\FacturationBundle\Entity\Produit $produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \PL\FacturationBundle\Entity\Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set libPrD
     *
     * @param string $libPrD
     * @return ProduitDevis
     */
    public function setLibPrD($libPrD)
    {
        $this->libPrD = $libPrD;

        return $this;
    }

    /**
     * Get libPrD
     *
     * @return string
     */
    public function getLibPrD()
    {
        return $this->libPrD;
    }

    /**
     * Set refPrd
     *
     * @param string $refPrd
     * @return ProduitDevis
     */
    public function setRefPrd($refPrd)
    {
        $this->refPrd = $refPrd;

        return $this;
    }

    /**
     * Get refPrd
     *
     * @return string
     */
    public function getRefPrd()
    {
        return $this->refPrd;
    }

    /**
     * Set ttcPrD
     *
     * @param float $ttcPrD
     * @return ProduitDevis
     */
    public function setTtcPrD($ttcPrD)
    {
        $this->ttcPrD = $ttcPrD;

        return $this;
    }

    /**
     * Get ttcPrD
     *
     * @return float
     */
    public function getTtcPrD()
    {
        return $this->ttcPrD;
    }

    /**
     * Set obsPrD
     *
     * @param string $obsPrD
     *
     * @return ProduitDevis
     */
    public function setObsPrD($obsPrD)
    {
        $this->obsPrD = $obsPrD;

        return $this;
    }

    /**
     * Get obsPrD
     *
     * @return string
     */
    public function getObsPrD()
    {
        return $this->obsPrD;
    }
}
