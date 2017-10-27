<?php

namespace PL\FacturationBundle\Controller;


use PL\FacturationBundle\Entity\Facture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PL\FacturationBundle\Form\FactureType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FactureController extends Controller
{
#####
public function indexAction(Request $request){
  $bool= $request->query->get('bool');
  $bool = (bool)$bool;
  $rp = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('PLFacturationBundle:Facture');
    if ($this->get('security.context')->isGranted('ROLE_HN')) {
      $drtFac = "hn";
    }
    if ($this->get('security.context')->isGranted('ROLE_PRIVATE')) {
      $drtFac = "private";
    }
  $listFacture = $rp->listFacture($bool,$drtFac); //false = facture  non archivée
  return $this->render('PLFacturationBundle:Facture:index.html.twig', array('listFacture'=>$listFacture,'bool'=>$bool));
}
#####
public function updateAction(Request $request,$id){
  $facture = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('PLFacturationBundle:Facture')->find($id);

    $form = $this->get('form.factory')->create(new FactureType, $facture);
    $form->add('remisepourcent','number',array(
        'mapped'=>false,
      //  'attr'=>array('placeholder'=>'0'),
      ))
      ->add('remise','number',array(
        'mapped'=>false,
        'attr'=>array('value'=>$facture->getRemfac()),
      ))
      ->add('apresremise','number',array(
        'mapped'=>false,
      'attr'=>array('readonly'=>'readonly'),
      ))
      ->add('rapFac','checkbox',array(

        'required'=>false,
      ))
      ->add('recFac','checkbox',array(

        'required'=>false,
      ))
      ->add('tieFac','checkbox',array(

        'required'=>false,
      ))
      ->add('paiFac','hidden')
      ->add('remFac','hidden')
      ->add('solFac','hidden')
      ->add('dtrFac','datetime',array(
        'attr'=>array(),
        'date_widget'=>'single_text',
        'time_widget'=>'single_text',
        'with_minutes'=>'false',
        'date_format'=>'dd/MM/yyyy',
        'required'=>false,
      ))
      ->add('drpFac','datetime',array(
        'attr'=>array(),
        'date_widget'=>'single_text',
        'time_widget'=>'single_text',
        'with_minutes'=>'false',
        'date_format'=>'dd/MM/yyyy',
        'required'=>false,
      ))
      ->add('drcFac','datetime',array(
        'attr'=>array(),
        'date_widget'=>'single_text',
        'time_widget'=>'single_text',
        'with_minutes'=>'false',
        'date_format'=>'dd/MM/yyyy',
        'required'=>false,
      ))
      ->add('obsFac','textarea',array(
        'required'=>false,
        'attr'=>array(
          'cols'=>60,
          'rows'=>4,

        ),
      ))

      ->add('enregistrer','submit',array(

        'attr'=>array(
          'class'=>'btn btn-info btn-sm',
        ),

      ));

    if ($form->handleRequest($request)->isValid()) {
      $date = $facture->getDatFac();
      $date = date_format($date, 'Y-m-d');

      $numerofacture = $date.'-'.$id;
      $now = new \DateTime();

      $em = $this->getDoctrine()->getManager();
      $data = $this->getRequest()->get('pl_facturationbundle_facture');
      $montant = $data['remise'];

      if (isset($data['rapFac'])){$rappel = $data['rapFac'];};
      $dateRappel = $data['drpFac']['date'];

      if (isset($data['recFac'])){$recouvrement = $data['recFac'];};
      $dateRecouvrement = $data['drcFac']['date'];

      if (isset($data['tieFac'])){$tierspayant = $data['tieFac'];};
      $dateTierspayant = $data['dtrFac']['date'];

      // on met à jour avec les valeurs du formulaire
      $delta = $data['remise'] - $data['remFac'];
      $facture->setSolFac( $data['solFac'] - $delta);
      $facture->setRemFac($data['remise']);


      if ($delta > 0){
        $compteDebit = $em
          ->getRepository('PLFacturationBundle:Compte')
          ->findCompteByType('700');
         if (null === $compteDebit) {
           throw new NotFoundHttpException("Echec de requête pour compteDébit");
         };

      $compteCredit = $em
          ->getRepository('PLFacturationBundle:Compte')
          ->findCompteByCarnet($facture->getCarnet());
      if (null === $compteCredit) {
            throw new NotFoundHttpException("Echec de requête pour compteCredit");
          };

      $libelleEcriture = "Remise sur facture ".$numerofacture." : ".$delta." Euros";
      $montant = $delta;
      $mouvement = $this->container->get('pl_facturation.mouvementfacture');
      $mouvement->mouvementfacture($compteCredit,$compteDebit,$libelleEcriture,$facture,$montant);
    }

    if ($delta < 0){
      $compteCredit = $em
        ->getRepository('PLFacturationBundle:Compte')
        ->findCompteByType('700');
       if (null === $compteCredit) {
         throw new NotFoundHttpException("Echec de requête pour compteDébit");
       };

    $compteDebit = $em
        ->getRepository('PLFacturationBundle:Compte')
        ->findCompteByCarnet($facture->getCarnet());
    if (null === $compteDebit) {
          throw new NotFoundHttpException("Echec de requête pour compteCredit");
        };

    $libelleEcriture = "Révision de remise sur facture ".$numerofacture." : ".$delta." €";
    $montant = - $delta;
    $mouvement = $this->container->get('pl_facturation.mouvementfacture');
    $mouvement->mouvementfacture($compteCredit,$compteDebit,$libelleEcriture,$facture,$montant);
  }
   // mise à jour date du rappel
if(isset($rappel) AND $dateRappel == null){
  $facture->setDrpFac($now);
  $facture->setObsFac($facture->getObsFac().date('j/n/y',time()).' : rappel envoyé');
} // mise à jours du 1/3 payant
if(isset($tierspayant) AND $dateTierspayant == null){
  $facture->setDtrFac($now);
  $facture->setObsFac($facture->getObsFac().date('j/n/y',time()).' : envoyée en 1/3 payant');
} // mise à jour du recouvrement
if(isset($recouvrement) AND $dateRecouvrement == null){
  $facture->setObsFac($facture->getObsFac().date('j/n/y',time()).' : mise en recouvrement');
  $facture->setDrcFac($now);
}

   $em->flush();

    if(isset($rappel)){
      return $this->redirectToRoute('pl_facturation_facture_index',array('goemail'=>true));
    }
    else {
      return $this->redirectToRoute('pl_facturation_facture_index');
    }
    }
  return $this->render('PLFacturationBundle:Facture:update.html.twig',array('form' => $form->createView(),'id'=>$id,'facture'=>$facture));
}
#####
  public function factureEnCoursPdfAction($id, Request $request){
    $goemail = $request->query->get('goemail');
    $goemailrappel = $request->query->get('goemailrappel');
    $em = $this
      ->getDoctrine()
      ->getManager();
    $rp = $em->getRepository('PLFacturationBundle:ProduitFacture');
    $listPfs = $rp->readProduitFacture($id);
    $html = $this->renderView('PLFacturationBundle:Facture:pdf_facture_encours.html.twig', array(
      'listPfs'=>$listPfs,
    ));
    $facture = $em->getRepository('PLFacturationBundle:Facture')->oneFacture($id);
    $nomCar = $facture[0]->getCarnet()->getNomCar();
    $prnCar = $facture[0]->getCarnet()->getPrnCar();
    $email = $facture[0]->getCarnet()->getMelCar();
    $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
    $html2pdf->pdf->SetDisplayMode('real');
    $html2pdf->writeHTML($html);

    // envoi d'un mail simple
    if ($goemail == true){
      $PDFdata = $html2pdf->Output('',true);
      $attachment = \Swift_Attachment::newInstance($PDFdata, 'Facture-'.$nomCar.'-'.$prnCar.'.pdf', 'application/pdf');
      $message = \Swift_Message::newInstance()
      ->setSubject('Note d\'honoraires du service de chirugie orale - CHU de Nîmes')
      ->setFrom('ne-pas-repondre@chirurgie-orale.fr')
      ->setTo($email)
      ->setBody(
          $this->renderView(
              'PLFacturationBundle:Facture:emailfactencours.html.twig'
          ),
          'text/html'
      )->attach($attachment);
    $this->get('mailer')->send($message);
    $facture[0]->setObsFac($facture[0]->getObsFac().date('j/n/y',time()).' : honoraires envoyés par mail');
    $em->flush();
    return $this->redirect($this->generateUrl('pl_facturation_facture_index'));

    // envoi d'um mail de rappel
  } elseif($goemailrappel == true){
    $PDFdata = $html2pdf->Output('',true);
    $attachment = \Swift_Attachment::newInstance($PDFdata, 'Facture-'.$nomCar.'-'.$prnCar.'.pdf', 'application/pdf');
    $message = \Swift_Message::newInstance()
    ->setSubject('RELANCE : Dr Ph. Lapeyrie - CHU de Nîmes')
    ->setFrom('philippe.lapeyrie@chu-nimes.fr')
    ->setTo($email)
    ->setBody(
      $this->renderView(
        'PLFacturationBundle:Facture:emailrappel.html.twig'
      )
    ,'text/html')
    ->attach($attachment);
    $this->get('mailer')->send($message);
    $response = new Response();
    $response->setContent(json_encode(array('id'=>$id)));
    $response->headers->set('Content-Type', 'application/json');
    return $response;

    // impression de la facture
  }  else {
    $html2pdf->Output('Facture-'.$nomCar.'-'.$prnCar.'.pdf');
    $response = new Response();
    $response->headers->set('Content-Type', 'application/pdf');
    return $response;
    }
  }

  #####
    public function factureArchiveePdfAction($id, Request $request){
      $rp = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('PLFacturationBundle:ProduitFacture');
      $listPfs = $rp->readProduitFacture($id);
      $rp = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('PLFacturationBundle:Facture');
      $facture = $rp->find($id);
      $rp = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('PLFacturationBundle:Mouvement');
      $listMouvements = $rp->findMouvementByFacture($id,$facture->getCarnet());


      $nomCar = $request->query->get('nomcar');
      $prnCar = $request->query->get('prncar');
      $darFac = $request->query->get('darfac');


      $html = $this->renderView('PLFacturationBundle:Facture:pdf_facture_archivee.html.twig', array(
        'listPfs'=>$listPfs,'darFac'=>$darFac,'nomCar'=>$nomCar,'prnCar'=>$prnCar,'listMouvements'=>$listMouvements,
      ));
      $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
      $html2pdf->pdf->SetDisplayMode('real');
      $html2pdf->writeHTML($html);
      $html2pdf->Output('Facture-archivée'.$nomCar.'-'.$prnCar.'.pdf');
      $response = new Response();
      $response->headers->set('Content-Type', 'application/pdf');
      return $response;
    }
#####
  public function lettreRappelPdfAction($id,Request $request){
    // utilisé également pour les lettres simples
    $lettresimple = $request->query->get('lettresimple');
    $rp = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('PLFacturationBundle:Facture');
    $facture = $rp->oneFacture($id);
    $nomCar = $facture[0]->getCarnet()->getNomCar();
    $prnCar = $facture[0]->getCarnet()->getPrnCar();
    if($lettresimple == true){// si c'est une lettre simple
      $html = $this->renderView('PLFacturationBundle:Facture:pdf_lettre_simple.html.twig',array('facture'=>$facture[0]));
    }else{ //sinon c'est une lettre de rappel
      $html = $this->renderView('PLFacturationBundle:Facture:pdf_lettre_rappel.html.twig',array('facture'=>$facture[0]));
    }
    $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
    $html2pdf->pdf->SetDisplayMode('real');
    $html2pdf->writeHTML($html);
    $html2pdf->Output('Lettre-rappel'.$nomCar.'-'.$prnCar.'.pdf');
    $response = new Response();
    $response->headers->set('Content-Type', 'application/pdf');
    return $response;
  }
#####
  public function archivageDirectAction($id){
    $em = $this
      ->getDoctrine()
      ->getManager();
    $facture = $em->getRepository('PLFacturationBundle:Facture')->find($id);
    $now = new \DateTime();
    $facture->setArcFac(true);
    $facture->setDarFac($now);
    $facture->setObsFac($facture->getObsFac().date('j/n/y',time()).' : facture archivée directement, non comptabilisée');
    $em->flush();
    return $this->redirect($this->generateUrl('pl_facturation_facture_index'));
  }
} //end controller
