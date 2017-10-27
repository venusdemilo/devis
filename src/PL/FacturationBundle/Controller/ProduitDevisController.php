<?php

namespace PL\FacturationBundle\Controller;
use PL\FacturationBundle\Form\ProduitDevisType;
use PL\FacturationBundle\Entity\ProduitDevis;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class ProduitDevisController extends Controller
{
#####
public function showAction($id){
  $rp = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('PLFacturationBundle:ProduitDevis');
  $listPds = $rp->findProduitDevis($id);
  return $this->render('PLFacturationBundle:ProduitDevis:show.html.twig', array('listPds'=>$listPds));
}
#####
public function updateAction($id){
  $rp = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('PLFacturationBundle:ProduitDevis');
  $listPds = $rp->findProduitDevis($id);



  return $this->render('PLFacturationBundle:ProduitDevis:update.html.twig', array('listPds'=>$listPds));

}
#####
public function recordAction(Request $request){

  $em = $this
    ->getDoctrine()
    ->getManager();
  $rp = $em->getRepository('PLFacturationBundle:ProduitDevis');
  $json = $request->request->get('obj');
  $jsonValidate = $this->get('pl_facturation.jsonvalidate');
  $arr = $jsonValidate->jsonvalidate($json);
  foreach ($arr as $k=>$l){
    if (empty($l)){
      unset($arr[$k]);
    }
  }
  foreach($arr as $key => $value){
    $pd = $rp->find($key);
    $pd->setObsPrd($value);
  }
  $em->flush();
// CRÉATION D'UNE RÉPONSE json
  $response = new Response();
  $response->setContent(json_encode(array('id'=>'ok')));
  $response->headers->set('Content-Type', 'application/json');
  return $response;

}
}
##END CONTROLLER
