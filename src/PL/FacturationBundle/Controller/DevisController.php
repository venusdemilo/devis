<?php

namespace PL\FacturationBundle\Controller;
use PL\FacturationBundle\Entity\Produit;
use PL\FacturationBundle\Entity\Devis;
use PL\FacturationBundle\Entity\ProduitDevis;
use PL\FacturationBundle\Entity\ProduitFacture;
use PL\FacturationBundle\Entity\Facture;
use PL\FacturationBundle\Entity\Compteur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Response;

class DevisController extends Controller
{
#####
  public function newAction($id){
    $em = $this->getDoctrine()->getManager();
    // gestion des droits sur la requête
    if ($this->get('security.context')->isGranted('ROLE_HN')) {
      $drtFam = "hn";
    }
    if ($this->get('security.context')->isGranted('ROLE_PRIVATE')) {
      $drtFam = "private";
    }
    if ($this->get('security.context')->isGranted('ROLE_PUBLIC')) {
      $drtFam = "public";
    }
    $listFamilles = $em->getRepository('PLFacturationBundle:Famille')->devisCreate($drtFam);
    $carnet= $em->getRepository('PLFacturationBundle:Carnet')->find($id);
    $nomCar = $carnet->getNomCar();
    $prnCar = $carnet->getPrnCar();


    return $this
      ->render('PLFacturationBundle:Devis:create.html.twig',
      array(
        'listFamilles'=>$listFamilles,
        'nomCar'=>$nomCar,
        'prnCar'=>$prnCar,
        'idCar'=>$id,
        'drtFam'=>$drtFam,
      )
    );
  }
#####
  public function indexAction(Request $request){
    $bool= $request->query->get('bool');
    $bool = (bool)$bool;
    if ($this->get('security.context')->isGranted('ROLE_HN')) {
      $drtDev = "hn";
    }
    if ($this->get('security.context')->isGranted('ROLE_PRIVATE')) {
      $drtDev = "private";
    }
    if ($this->get('security.context')->isGranted('ROLE_PUBLIC')) {
      $drtDev = "public";
    }
    $rp = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('PLFacturationBundle:Devis');
    $listDevis = $rp->indexDevis($bool,$drtDev); //false = devis non archivés
    return $this->render('PLFacturationBundle:Devis:index.html.twig', array('listDevis'=>$listDevis,'bool'=>$bool));
  }
#####
  public function devisRecordAction(Request $request){
    /* Ce contrôleur ne renvoie rien du tout ! Sauf peut-être
    une réponse "OK" - code 200 , à la réception du JSON ? FIXME !
    */
    $user = $this->getUser();
    $json = $request->request->get('obj');
    $idCar = $request->request->get('idCar');
    $drtFam = $request->request->get('drtFam');
    $jsonValidate = $this->get('pl_facturation.jsonvalidate');
    $arr = $jsonValidate->jsonvalidate($json);
    // purge des valeurs vides
    foreach ($arr as $k=>$l){
      if (empty($l)){
        unset($arr[$k]);
      }
      else{
        if(!$l=settype($l,"integer")){
          throw new NotFoundHttpException("Type de donnée non conforme");
        }
        if(!$k=settype($k,"integer")){
          throw new NotFoundHttpException("Type de donnée non conforme");
        }
      }
    }
    //Calcul de la date de péremption du devis
    $now = new \DateTime();
    $interval = new \DateInterval('P6M');
    $dpdDev = $now->add($interval);
    //actualisation compteur
    $em = $this->getDoctrine()->getManager();
    $compteur = $em->getRepository('PLFacturationBundle:Compteur')->find(1);
    $compteur->setDecCom($compteur->getDecCom()+1);
    $devisSave = $this->get('pl_facturation.devissave');
    $devisSave->devissave($arr,$idCar,$user,$dpdDev,$drtFam);
    $response = new Response();
    $response->setContent(json_encode(array('id'=>$idCar)));
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }
#####
  public function devisPdfAction($id, Request $request){
    $rp = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('PLFacturationBundle:ProduitDevis');
    $listPds = $rp->readProduitDevis($id);
    $nomCar = $request->query->get('nomcar');
    $prnCar = $request->query->get('prncar');
    $datDev = $request->query->get('datdev');
    $goemail = $request->query->get('goemail');
    $email = $request->query->get('email');

    //return new Response ('Yessss !');
    //return $this->render('PLFacturationBundle:Devis:devisread.html.twig', array('listPds'=>$listPds));
    $html = $this->renderView('PLFacturationBundle:Devis:pdf_devis.html.twig', array(
      'listPds'=>$listPds,
      'nomCar'=>$nomCar,
      'prnCar'=>$prnCar,
      'datDev'=>$datDev

    ));
    $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
    $html2pdf->pdf->SetDisplayMode('real');
    $html2pdf->writeHTML($html);
    if ($goemail == true){
      $PDFdata = $html2pdf->Output('',true);
      $attachment = \Swift_Attachment::newInstance($PDFdata, 'Devis-'.$nomCar.'-'.$prnCar.'.pdf', 'application/pdf');
      $message = \Swift_Message::newInstance()
      ->setSubject('Devis du service de chirugie orale - CHU de Nîmes')
      ->setFrom('nepasrepondre@chirurgie-orale.fr')
      ->setTo($email)
      ->setBody(
          $this->renderView(
              // app/Resources/views/Emails/registration.html.twig
              'PLFacturationBundle:Devis:email.html.twig'
          ),
          'text/html'
      )->attach($attachment);
       $this->get('mailer')->send($message);
       $em = $this->getDoctrine()->getManager();
       $devis = $em
         ->getRepository('PLFacturationBundle:Devis')->find($id);
      $devis->setObsDev(date('j/n/y',time()).' : devis envoyé par mail');
      $em->flush();
    return $this->redirect($this->generateUrl('pl_facturation_devis_index'));

    }
    else{
    $html2pdf->Output('Devis-'.$nomCar.'-'.$prnCar.'.pdf');
    $response = new Response();
    $response->headers->set('Content-Type', 'application/pdf');
    return $response;
  }
  }
#####
// pour obtenir des factures acquitées directement à partir des devis sur des droits publics
public function facacquitteePdfAction($id, Request $request){
  $rp = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('PLFacturationBundle:ProduitDevis');
  $listPds = $rp->readProduitDevis($id);
  $nomCar = $request->query->get('nomcar');
  $prnCar = $request->query->get('prncar');
  $datDev = $request->query->get('datdev');
  $goemail = $request->query->get('goemail');
  $email = $request->query->get('email');

  $html = $this->renderView('PLFacturationBundle:Devis:pdf_facacquittee.html.twig', array(
    'listPds'=>$listPds,
    'nomCar'=>$nomCar,
    'prnCar'=>$prnCar,
    'datDev'=>$datDev

  ));

  $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
  $html2pdf->pdf->SetDisplayMode('real');
  $html2pdf->writeHTML($html);

  $html2pdf->Output('Devis-'.$nomCar.'-'.$prnCar.'.pdf');
  $response = new Response();
  $response->headers->set('Content-Type', 'application/pdf');
  return $response;
} // end func

#####
public function deleteAction(Request $request, $id){
  $em = $this->getDoctrine()->getManager();
  //actualisation compteur
  $compteur = $em->getRepository('PLFacturationBundle:Compteur')->find(1);
  $compteur->setDecCom($compteur->getDecCom()-1);

  $listProduitsDevis = $em->getRepository('PLFacturationBundle:ProduitDevis')->findProduitDevis($id);
  if (null === $listProduitsDevis) {
    throw new NotFoundHttpException("Devis introuvable");
  }
  foreach ($listProduitsDevis as $pd){
    $em->remove($pd);
  }

  $em->flush();
    return $this->redirect($this->generateUrl('pl_facturation_devis_index'));
}
#####
public function devisToFactureAction($id){
  $em = $this
    ->getDoctrine()
    ->getManager();
  $rp = $em->getRepository('PLFacturationBundle:ProduitDevis');
  $listProduitsDevis = $rp->devisToFacture($id);
  $devis = $em->getRepository('PLFacturationBundle:Devis')->find($id);
  $now = new \DateTime();
  $devis->setDarDev($now);
  $facture = new Facture();
  //Calcul de la date de péremption de la facture
  $interval = new \DateInterval('P1M');
  $dpfFac = $now->add($interval);
  $facture->setDpfFac($dpfFac);
  //Affectation des droits
  $facture->setDrtFac($devis->getDrtDev());
  //Utilisateur en cours
  $user = $this->getUser();
  $facture->setUser($user);
  //Affectation de l'observation
  $facture->setObsFac($devis->getObsDev());
  //Actualisation compteur
  $compteur = $em->getRepository('PLFacturationBundle:Compteur')->find(1);
  $compteur->setDecCom($compteur->getDecCom()-1);
  $compteur->setDarCom($compteur->getDarCom()+1);
  $compteur->setFecCom($compteur->getFecCom()+1);
  $em->flush();

  foreach ($listProduitsDevis as $produitDevis) {
    $produitFacture = new ProduitFacture();
    $produitFacture->setFacture($facture);
    $produitFacture->setProduit($produitDevis->getProduit());
    $produitFacture->setQuaPrd($produitDevis->getQuaPrd());
    $produitFacture->setLibPrd($produitDevis->getLibPrd());
    $produitFacture->setRefPrd($produitDevis->getRefPrd());
    $produitFacture->setTtcPrd($produitDevis->getTtcPrd());
    $produitFacture->setObsPrd($produitDevis->getObsPrd());
    $facture->setDevis($produitDevis->getDevis());
    $facture->setCarnet($produitDevis->getDevis()->getCarnet());
    $facture->setTotFac($produitDevis->getDevis()->getTotDev());
    $em->persist($produitFacture);
    // archivage devis
    $produitDevis->getDevis()->setArcDev(true);

  }
  $em->persist($facture);
  $em->flush();

  //return $this->render('PLFacturationBundle:Facture:factureencourslist.html.twig');
  return $this->redirectToRoute('pl_facturation_facture_index');
}

} ////// END CLASS ##END CONTROLLER
