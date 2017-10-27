<?php

namespace PL\FacturationBundle\Controller;


use PL\FacturationBundle\Entity\Compte;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class CompteController extends Controller
{
#####
    public function showAction(Request $request){
      if ($this->get('security.context')->isGranted('ROLE_HN')) {
        $drtFac='hn';
      }
      if ($this->get('security.context')->isGranted('ROLE_PRIVATE')) {
        $drtFac='private';
      }
      $typCom=700;
      if(isset($_GET['start'])){$start = $_GET['start'];}else{$start=date('Y-n').'-01';};
      if(isset($_GET['end'])){$end = $_GET['end'];}else{$end=date('Y-n-j');};
      $em = $this->getDoctrine()->getManager();
      //$listMouvement = $em->getRepository('PLFacturationBundle:Mouvement')->findMouvementByTypeCompte($typCom,$drtFac,$start,$end);
      $listMouvement = $em->getRepository('PLFacturationBundle:Mouvement')->findCreMouByDate($typCom,$start,$end,$drtFac);
      return $this->render('PLFacturationBundle:Compte:show.html.twig',
        array(
          'listMouvement'=>$listMouvement,
          'typCom'=>$typCom,
          'drtFac'=>$drtFac,
          'start'=>$start,
          'end'=>$end
        )
      );

  }
}
##END CONTROLLER
