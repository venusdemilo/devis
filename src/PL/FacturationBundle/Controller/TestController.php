<?php

namespace PL\FacturationBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PL\FacturationBundle\Entity\Carnet;

class TestController extends Controller
{
#####


  public function emailAction(Request $request){
    $html = $this->renderView('PLFacturationBundle:Test:pdftest.html.twig');
    $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
    $html2pdf->pdf->SetDisplayMode('real');
    $html2pdf->writeHTML($html);
      $PDFdata = $html2pdf->Output('',true);

  $attachment = \Swift_Attachment::newInstance($PDFdata, 'my-file.pdf', 'application/pdf');

  $message = \Swift_Message::newInstance()
      ->setSubject('Hello Email')
      ->setFrom('send@example.com')
      ->setTo('recipient@example.com')
      ->setBody(
          $this->renderView(
              // app/Resources/views/Emails/registration.html.twig
              'PLFacturationBundle:Test:registration.html.twig'
          ),
          'text/html'
      )->attach($attachment);
       $this->get('mailer')->send($message);

       $listCarnets = $this
         ->getDoctrine()
         ->getManager()
         ->getRepository('PLFacturationBundle:Carnet')->findAll();
       return $this->render('PLFacturationBundle:Carnet:index.html.twig',array('listCarnets'=>$listCarnets));


  }
}
##END CONTROLLER
