<?php

namespace PL\FacturationBundle\Controller;

use PL\FacturationBundle\Entity\Compteur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class CompteurController extends Controller
{
#####
    public function indexAction(){
      $em = $this->getDoctrine()->getManager();
      $compteur = $em->getRepository('PLFacturationBundle:Compteur')->find(1);
      return $this->render('PLFacturationBundle:Compteur:index.html.twig', array('compteur'=>$compteur));
    }
}
##END CONTROLLER
