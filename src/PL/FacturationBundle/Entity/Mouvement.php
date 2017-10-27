<?php

namespace PL\FacturationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mouvement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PL\FacturationBundle\Entity\MouvementRepository")
 */
class Mouvement
{
  /**
   * @ORM\ManyToOne(targetEntity="PL\FacturationBundle\Entity\Compte")
   * @ORM\ JoinColumn(nullable=false)
   */
   private $compte;

   /**
    * @ORM\OneToOne(targetEntity="PL\FacturationBundle\Entity\Ecriture")
    * @ORM\ JoinColumn(nullable=false)
    */
    private $ecriture;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="debMou", type="float")
     */
    private $debMou;

    /**
     * @var float
     *
     * @ORM\Column(name="creMou", type="float")
     */
    private $creMou;


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
     * Set debMou
     *
     * @param float $debMou
     *
     * @return Mouvement
     */
    public function setDebMou($debMou)
    {
        $this->debMou = $debMou;

        return $this;
    }

    /**
     * Get debMou
     *
     * @return float
     */
    public function getDebMou()
    {
        return $this->debMou;
    }

    /**
     * Set creMou
     *
     * @param float $creMou
     *
     * @return Mouvement
     */
    public function setCreMou($creMou)
    {
        $this->creMou = $creMou;

        return $this;
    }

    /**
     * Get creMou
     *
     * @return float
     */
    public function getCreMou()
    {
        return $this->creMou;
    }

    /**
     * Set compte
     *
     * @param \PL\FacturationBundle\Entity\Compte $compte
     *
     * @return Mouvement
     */
    public function setCompte(\PL\FacturationBundle\Entity\Compte $compte)
    {
        $this->compte = $compte;

        return $this;
    }

    /**
     * Get compte
     *
     * @return \PL\FacturationBundle\Entity\Compte
     */
    public function getCompte()
    {
        return $this->compte;
    }

    /**
     * Set ecriture
     *
     * @param \PL\FacturationBundle\Entity\Ecriture $ecriture
     *
     * @return Mouvement
     */
    public function setEcriture(\PL\FacturationBundle\Entity\Ecriture $ecriture)
    {
        $this->ecriture = $ecriture;

        return $this;
    }

    /**
     * Get ecriture
     *
     * @return \PL\FacturationBundle\Entity\Ecriture
     */
    public function getEcriture()
    {
        return $this->ecriture;
    }
}
