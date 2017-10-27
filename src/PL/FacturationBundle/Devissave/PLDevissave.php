<?php
namespace PL\FacturationBundle\Devissave;

//use PL\FacturationBundle\Entity\Produit;
use PL\FacturationBundle\Entity\Carnet;
use PL\FacturationBundle\Entity\Devis;
use PL\FacturationBundle\Entity\ProduitDevis;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\Common\Collections\ArrayCollection;


class PLDevissave
{
  private $em = null;

  public function __construct($em)
  {
    $this->em = $em;
  }

  public function devissave(Array $arr,$idCar,$user,$dpdDev,$drtFam){
  $totalDevis=0;
  $i=0;
  $listProduits = $this->em->getRepository('PLFacturationBundle:Produit')->listProduits();
  $carnet = $this->em->getRepository('PLFacturationBundle:Carnet')->find($idCar);
  if (null === $carnet) {
    throw new NotFoundHttpException("ID table 'carnet' inexistante");
  }
  $devis = new Devis();
    foreach ($arr as $idProduit=>$quantiteProduit){

              foreach ($listProduits as $produit)
              {
                if($produit->getId()==$idProduit){
                  $totalDevis=$totalDevis + ($quantiteProduit*$produit->getTtcProd());
                  $$i= new ProduitDevis();
                  $$i->setDevis($devis);
                  $$i->setQuaPrd($quantiteProduit);
                  $$i->setLibPrD($produit->getLibProd());
                  $$i->setRefPrD($produit->getRefProd());
                  $$i->setTtcPrD($produit->getTtcProd());
                  $$i->setProduit($produit);
                  $this->em->persist($$i);
                }
              }
              $i++;
    }
    $devis->setDpdDev($dpdDev);
    $devis->setTotDev($totalDevis);
    $devis->setCarnet($carnet);
    $devis->setUser($user);
    $devis->setDpdDev($dpdDev);
    $devis->setDrtDev($drtFam);
    $this->em->persist($devis);
    $this->em->flush();
  }
}
