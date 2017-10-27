<?php
namespace PL\FacturationBundle\Mouvementvalidfacture;

use PL\FacturationBundle\Entity\Ecriture;
use PL\FacturationBundle\Entity\Mouvement;
use PL\FacturationBundle\Entity\Facture;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PLMouvementvalidfacture
{
  private $em = null;
  private $racineCompteCredit;
  private $typeCompteDebit;
  private $libelleEcriture;
  private $typeCompteCredit;

  public function __construct($em,$racineCompteCredit,$typeCompteDedit,$libelleEcriture)
  {
    $this->em = $em;
    $this->racineCompteDebit = $racineCompteDebit;
    $this->typeCompteCredit = $typeCompteCredit;
    $this->libelleEcriture = $libelleEcriture;
  }
  public function mouvementunvalidfacture($id){

  }//END FUNC


}//END CLASS
