<?php

namespace PL\FacturationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProduitFacture
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PL\FacturationBundle\Entity\ProduitFactureRepository")
 */
class ProduitFacture
{

  /**
   * @ORM\ManyToOne(targetEntity="PL\FacturationBundle\Entity\Facture")
   * @ORM\ JoinColumn(nullable=false)
   */
   private $facture;

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
     * @ORM\Column(name="quaPrd", type="integer")
     */
    private $quaPrd;

    /**
     * @var string
     *
     * @ORM\Column(name="libPrd", type="string", length=255)
     */
    private $libPrd;

    /**
     * @var string
     *
     * @ORM\Column(name="refPrd", type="string", length=255)
     */
    private $refPrd;

    /**
     * @var float
     *
     * @ORM\Column(name="ttcPrd", type="float")
     */
    private $ttcPrd;

    /**
     * @var string
     *
     * @ORM\Column(name="obsPrD", type="string", length=255, nullable=true)
     */
    private $obsPrD;


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
     * Set quaPrd
     *
     * @param integer $quaPrd
     *
     * @return ProduitFacture
     */
    public function setQuaPrd($quaPrd)
    {
        $this->quaPrd = $quaPrd;

        return $this;
    }

    /**
     * Get quaPrd
     *
     * @return integer
     */
    public function getQuaPrd()
    {
        return $this->quaPrd;
    }

    /**
     * Set libPrd
     *
     * @param string $libPrd
     *
     * @return ProduitFacture
     */
    public function setLibPrd($libPrd)
    {
        $this->libPrd = $libPrd;

        return $this;
    }

    /**
     * Get libPrd
     *
     * @return string
     */
    public function getLibPrd()
    {
        return $this->libPrd;
    }

    /**
     * Set refPrd
     *
     * @param string $refPrd
     *
     * @return ProduitFacture
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
     * Set ttcPrd
     *
     * @param float $ttcPrd
     *
     * @return ProduitFacture
     */
    public function setTtcPrd($ttcPrd)
    {
        $this->ttcPrd = $ttcPrd;

        return $this;
    }

    /**
     * Get ttcPrd
     *
     * @return float
     */
    public function getTtcPrd()
    {
        return $this->ttcPrd;
    }

    /**
     * Set facture
     *
     * @param \PL\FacturationBundle\Entity\Facture $facture
     *
     * @return ProduitFacture
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
     * Set produit
     *
     * @param \PL\FacturationBundle\Entity\Produit $produit
     *
     * @return ProduitFacture
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
     * Set obsPrD
     *
     * @param string $obsPrD
     *
     * @return ProduitFacture
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
