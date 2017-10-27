<?php

namespace PL\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PLCoreBundle:Default:home.html.twig');
    }
}
