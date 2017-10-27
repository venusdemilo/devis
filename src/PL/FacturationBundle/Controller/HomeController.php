<?php

namespace PL\FacturationBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
  #####
    public function homeAction(){
      return $this->render('PLFacturationBundle:Home:home.html.twig');
    }//end function

} // END CONTROLLER
