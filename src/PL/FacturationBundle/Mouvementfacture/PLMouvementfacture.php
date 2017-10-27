<?php
namespace PL\FacturationBundle\Mouvementfacture;

use PL\FacturationBundle\Entity\Ecriture;
use PL\FacturationBundle\Entity\Mouvement;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PLMouvementfacture
{
private $em = null;

public function __construct($em)
{
  $this->em = $em;
}

  public function mouvementfacture($compteCredit,$compteDebit,$libelleEcriture,$facture,$montant){
     $mouvementCredit = new Mouvement;
     $mouvementDebit = new Mouvement;
     $ecritureDebit = new Ecriture;
     $ecritureCredit = new Ecriture;

     $ecritureDebit->setFacture($facture);
     $ecritureDebit->setLibEcr($libelleEcriture);
     $this->em->persist($ecritureDebit);

     $mouvementDebit->setEcriture($ecritureDebit);
     $mouvementDebit->setCompte($compteDebit);
     $mouvementDebit->setDebMou($montant);
     $mouvementDebit->setCreMou(0);
     $this->em->persist($mouvementDebit);

     $ecritureCredit->setFacture($facture);
     $ecritureCredit->setLibEcr($libelleEcriture);
     $this->em->persist($ecritureCredit);

     $mouvementCredit->setEcriture($ecritureCredit);
     $mouvementCredit->setCompte($compteCredit);
     $mouvementCredit->setCreMou($montant);
     $mouvementCredit->setDebMou(0);
     $this->em->persist($mouvementCredit);

     $this->em->flush();
  }// end func.
}// END CLASS
