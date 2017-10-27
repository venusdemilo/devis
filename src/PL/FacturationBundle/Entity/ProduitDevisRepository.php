<?php

namespace PL\FacturationBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProduitDevisRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduitDevisRepository extends EntityRepository
{
  public function readProduitDevis($id){
    $qb = $this->createQueryBuilder('pd');
    $qb
      ->Join('pd.produit','produit')
      ->addSelect('produit')
      ->Join('produit.infoproduit','infoproduit')
      ->addSelect('infoproduit')
      ->Join('pd.devis','devis')
      ->addSelect('devis')
      ->Join('devis.carnet','carnet')
      ->addSelect('carnet')
      ->Join('devis.user','user')
      ->addSelect('user')
      ->where('devis.id = :id')
      ->setParameter('id',$id)
      ;
      return  $qb
        ->getQuery()
        ->getArrayResult();

  }

  public function devisToFacture($id){
    $qb = $this->createQueryBuilder('pd');
    $qb
      ->Join('pd.devis','devis')
      ->addSelect('devis')
      ->where('devis.id = :id')
      ->setParameter('id',$id)
      ;
      // renvoi un objet à manipuler
      return  $qb
        ->getQuery()
        ->getResult();

  }

  public function findProduitDevis($id){
    //cherche les produits devis par ID de devis
    $qb = $this->createQueryBuilder('pd');
    $qb
      ->where('pd.devis = :id')
      ->setParameter('id',$id)
    ;
    // renvoi un objet à manipuler
    return  $qb
      ->getQuery()
      ->getResult();
  }

}
