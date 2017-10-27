<?php

namespace PL\FacturationBundle\Controller;


use PL\FacturationBundle\Entity\Ecriture;
use PL\FacturationBundle\Entity\Mouvement;
use PL\FacturationBundle\Entity\Facture;
use PL\FacturationBundle\Form\FactureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MouvementController extends Controller
{
#####
  public function mouvementValidFactureAction($idFacture){
    $em = $this->getDoctrine()->getManager();
    $compteCredit = $em->getRepository('PLFacturationBundle:Compte')->findCompteByType('700');
     if (null === $compteCredit) {
       throw new NotFoundHttpException("Echec de requête pour compteCredit");
     };
     $facture = $em->getRepository('PLFacturationBundle:Facture')->find($idFacture);
      if (null === $facture) {
        throw new NotFoundHttpException("Echec de requête pour facture");
      };
      // validation facture
      if(! $facture->getVldFac()){
        $facture->setVldFac(true);
      }
      else {
        throw new NotFoundHttpException("Facture déjà archivée.");
      }

      $totFac = $facture->getTotFac();
      $solFac = $facture->getSolFac();
      //incrémentation du solde
      if($solFac>0){$solFac = $totFac - $solFac;}
      if($solFac==0){$solFac = $totFac;}
      if($solFac<0){$solFac = $totFac + $solFac;}
      $facture->setSolFac($solFac);

      $compteDebit = $em
        ->getRepository('PLFacturationBundle:Compte')
        ->findCompteByCarnet($facture->getCarnet()->getId());
       if (null === $compteDebit) {
         throw new NotFoundHttpException("Echec de requête pour compteDebit");
       };
       $date = $facture->getDatFac();
       $date = date_format($date, 'Y-m-d');
       $numerofacture = $date.'-'.$idFacture;
       $libelleEcriture = "Validation facture n° ".$numerofacture;
       $montant = $facture->getTotFac();
    $mouvement = $this->container->get('pl_facturation.mouvementfacture');
    $mouvement->mouvementfacture($compteCredit,$compteDebit,$libelleEcriture,$facture,$montant);
    $response = new Response();
    $response->setContent(json_encode(array('idFacture'=>$idFacture)));
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }
#####
  public function mouvementUnvalidFactureAction($idFacture){
    $em = $this->getDoctrine()->getManager();
    $compteDebit = $em->getRepository('PLFacturationBundle:Compte')->findCompteByType('700');
     if (null === $compteDebit) {
       throw new NotFoundHttpException("Echec de requête pour compteDébit");
     };
     $facture = $em->getRepository('PLFacturationBundle:Facture')->find($idFacture);
      if (null === $facture) {
        throw new NotFoundHttpException("Echec de requête pour facture");
      };
      // dévalidation facture
      if($facture->getVldFac()){
        $facture->setVldFac(false);
      }
      else {
        throw new NotFoundHttpException("Facture non archivée.");
      }

      $totFac = $facture->getTotFac();
      $solFac = $facture->getSolFac();
      //décrémentation du solde
      if ($solFac>0 && $solFac != $totFac){
        $solFac = -($totFac - $solFac);
      }
      else{
        $solFac = 0;
      }
     $facture->setSolFac($solFac);

      $compteCredit = $em
        ->getRepository('PLFacturationBundle:Compte')
        ->findCompteByCarnet($facture->getCarnet()->getId());
       if (null === $compteCredit) {
         throw new NotFoundHttpException("Echec de requête pour compteCrdit");
       };
       $date = $facture->getDatFac();
       $date = date_format($date, 'Y-m-d');
       $numerofacture = $date.'-'.$idFacture;
       $libelleEcriture = "Dévalidation facture n° ".$numerofacture;
       $montant = $facture->getTotFac();
    $mouvement = $this->container->get('pl_facturation.mouvementfacture');
    $mouvement->mouvementfacture($compteCredit,$compteDebit,$libelleEcriture,$facture,$montant);
    $response = new Response();
    $response->setContent(json_encode(array('idFacture'=>$idFacture)));
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }

  public function mouvementReglementFactureAction(Request $request,$idFacture){
    $em = $this->getDoctrine()->getManager();
    $facture = $em->getRepository('PLFacturationBundle:Facture')->find($idFacture);
    $totFac = $facture->getTotFac();
    $solFac = $facture->getSolFac();

    $dejaPaye = $totFac-$solFac;
    $mouvement = new Mouvement();
    $ecriture = new Ecriture();
    $form = $this->get('form.factory')->create(new FactureType, $facture);
    $form
    ->remove('dpfFac')
    ->add('paiFac','number',array(

      'attr'=>array('readonly'=>'readonly'),
    ))
    ->add('remFac','number',array(

      'attr'=>array('readonly'=>'readonly'),
    ))

    ->add('paiement','number',array(
      'mapped'=> false,
      'required'=>false,
      'attr'=>array('value'=>$solFac,),
    ))
    ->add('modepaiement','choice',array(
      'mapped'=> false,
      'required'=>true,
      'choices'=>array(
        'chèque'=>'chèque',
        'CB'=>"CB",
        'Espèces'=>'Espèces',
        'Virement'=>'Virement',
      ),
      'placeholder' => false,
      'preferred_choices' => array('chèque'),
      'choices_as_values' => true,
    ))
    ->add('banque','text',array(
      'mapped'=> false,
      'required'=>false,
    ))
    ->add('numcheque','text',array(
      'mapped'=> false,
      'required'=>false,
    ))
    ->add('porteur','text',array(
      'mapped'=> false,
      'required'=>false,
    ))
    ->add('enregistrer','submit', array('attr'=> array('class'=>'btn btn-info')))
    ;


    if ($form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $data = $this->getRequest()->get('pl_facturationbundle_facture');


      $date = $facture->getDatFac();
      $date = date_format($date, 'Y-m-d');
      $numerofacture = $date.'-'.$idFacture;
      $montant = $data['paiement'];

      // si facture soldée
      if ($montant == $solFac){
        // actualisation du compteur
        $compteur = $em->getRepository('PLFacturationBundle:Compteur')->find(1);
        $compteur->setFecCom($compteur->getFecCom()-1);
        $compteur->setFarCom($compteur->getFarCom()+1);
      $libelleEcriture = "Solde facture ".$numerofacture." : ".$data['modepaiement']." ".$data['banque']." ".$data['numcheque']." ".$data['porteur'];
      // solde facture réglée =0
      $facture->setSolFac(0);
      // ajustement du paiement
      $facture->setPaiFac($facture->getPaiFac() + $montant);
      // archivage facture
      $facture->setArcFac(true);
      // date archivage
      $now = new \DateTime();
      $facture->setDarFac($now);
      }

      // si paiement partiel
      elseif($montant < $solFac ) {
      $libelleEcriture = "Règlement partiel sur facture ".$numerofacture." : ".$data['modepaiement']." ".$data['banque']." ".$data['numcheque']." ".$data['porteur'];
      //ajustement du solde
      $facture->setSolFac($solFac-$montant);
      // ajustement du paiement
      $facture->setPaiFac($facture->getPaiFac() + $montant);
      }
      $compteCredit = $em
          ->getRepository('PLFacturationBundle:Compte')
          ->findCompteByCarnet($facture->getCarnet()->getId());
         if (null === $compteCredit) {
           throw new NotFoundHttpException("Echec de requête pour compteCredit");
         };
      $compteDebit = $em->getRepository('PLFacturationBundle:Compte')->findCompteByType('700');
          if (null === $compteDebit) {
            throw new NotFoundHttpException("Echec de requête pour compteDébit");
          };

      $mouvement = $this->container->get('pl_facturation.mouvementfacture');
      $mouvement->mouvementfacture($compteCredit,$compteDebit,$libelleEcriture,$facture,$montant);
      return $this->redirectToRoute('pl_facturation_facture_index');
    }// endif
    return $this->render(
      'PLFacturationBundle:Mouvement:paiement.html.twig',
      array(
      'facture'=>$facture,
        'form'=>$form->createView())
      );
  }

}// END CONTROLLER
