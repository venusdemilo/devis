<?php

namespace PL\FacturationBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Famille
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PL\FacturationBundle\Entity\FamilleRepository")
 */
class Famille
{


/**
 * @var \DateTime
 *
 * @ORM\Column(name="datFam", type="datetime")
 */
private $datFam;

    /**
     * @ORM\OneToMany(targetEntity="PL\FacturationBundle\Entity\Produit", mappedBy="famille")
     */

    private $produits;

    /**
     * @ORM\ManyToOne(targetEntity="PL\UserBundle\Entity\User")
     * @ORM\ JoinColumn(nullable=false)
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
     * @ORM\Column(name="libFam", type="string", length=255)
     */
    private $libFam;

    /**
     * @var string
     *
     * @ORM\Column(name="drtFam", type="string", length=10)
     */
    private $drtFam;


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
     * Set libFam
     *
     * @param string $libFam
     * @return Famille
     */
    public function setLibFam($libFam)
    {
        $this->libFam = $libFam;

        return $this;
    }

    /**
     * Get libFam
     *
     * @return string
     */
    public function getLibFam()
    {
        return $this->libFam;
    }
    public function __construct()
    {
      // Date de création de la famille
      $this->datFam = new \Datetime();
      $this->produits=new ArrayCollection();
    }

    public function addProduit(Produit $produit)
    {
      $this->produits[] = $produit;
      $produit->setFamille($this);
      return $this;
    }

    public function removeProduit(Produit $produit)
    {
      $this->produits->removeElement($produit);
      $produit->setFamille(null);
    }

    public function getProduits()
    {
      return $this->produits;
    }


    /**
     * Set user
     *
     * @param \PL\UserBundle\Entity\User $user
     *
     * @return Famille
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
     * Set datFam
     *
     * @param \DateTime $datFam
     *
     * @return Famille
     */
    public function setDatFam($datFam)
    {
        $this->datFam = $datFam;

        return $this;
    }

    /**
     * Get datFam
     *
     * @return \DateTime
     */
    public function getDatFam()
    {
        return $this->datFam;
    }

    /**
     * Set drtFam
     *
     * @param string $drtFam
     *
     * @return Famille
     */
    public function setDrtFam($drtFam)
    {
        $this->drtFam = $drtFam;

        return $this;
    }

    /**
     * Get drtFam
     *
     * @return string
     */
    public function getDrtFam()
    {
        return $this->drtFam;
    }
}
