<?php

namespace PL\FacturationBundle\Controller;
use PL\FacturationBundle\Entity\Carnet;
use PL\FacturationBundle\Entity\Statut;
use PL\FacturationBundle\Entity\Compte;
use PL\FacturationBundle\Entity\Compteur;
use PL\FacturationBundle\Form\CarnetType;
use PL\FacturationBundle\Form\CarnetUpdateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class CarnetController extends Controller
{
#####
    public function indexAction(){
      //$em = $this->getDoctrine()->getManager();
      $listCarnets = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('PLFacturationBundle:Carnet')->myFindAll();
      return $this->render('PLFacturationBundle:Carnet:index.html.twig',array('listCarnets'=>$listCarnets));
    }
######
    public function newAction(Request $request)
    {
        $carnet = new Carnet;
        $compte = new Compte;
        $compte->setCarnet($carnet);
        $compte->setTypCom('411');
        $carnet->setStaCar(false);// false = client , true = fournisseur
        $form = $this->get('form.factory')->create(new CarnetType, $carnet);



      if ($form->handleRequest($request)->isValid()) {
        $em = $this->getDoctrine()->getManager();
        // MAJ du compteur
        $compteur = $em->getRepository('PLFacturationBundle:Compteur')->find(1);
        $oldCarCom = $compteur->getCarCom();
        $newCarCom= $oldCarCom +1;
        $compteur->setCarCom($newCarCom);
        $data = $this->getRequest()->get('pl_facturationbundle_carnet');
        // TTT du nom  du prénom et de la ville
        $carnet->setNomCar(strtoupper($data['nomCar']));
        $carnet->setPrnCar(ucwords(strtolower($data['prnCar'])));
        $carnet->setVilCar(strtoupper($data['vilCar']));
        /// TTT de l'adresse (affectéé à rueCar en BDD)
        $carnet->setRueCar($data['numerovoie'].'*'.$data['typevoie'].'*'.$data['nomvoie'].'*'.$data['complement']);
        ///TTT téléphone
        $carnet->setTelCar($data['tel1'].'.'.$data['tel2'].'.'.$data['tel3'].'.'.$data['tel4'].'.'.$data['tel5']);
        $em->persist($carnet);


        $libelleCompte = "client ".$carnet->getNomCar()." ".$carnet->getPrnCar();
        $compte->setLibCom($libelleCompte);
        $em->persist($compte);
        $em->flush();
        $id=$carnet->getId();
        $response = new Response();
        $response->setContent(json_encode(array('id'=>$id)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }
      return $this->render('PLFacturationBundle:Carnet:new.html.twig',array(
      'form'=>$form->createView()
      ));
    }
#####
  public function  updateAction(Request $request, $id){
      $carnet = $this->getDoctrine()->getManager()->getRepository('PLFacturationBundle:Carnet')->find($id);
      $telCar=explode('.',$carnet->getTelCar());
      $rueCar=explode('*',$carnet->getRueCar());
      $form = $this->get('form.factory')->create(new CarnetType, $carnet);
      $form->remove('tel1')
      ->remove('tel2')
      ->remove('tel3')
      ->remove('tel4')
      ->remove('tel5')
      ->remove('numerovoie')
      ->remove('typevoie')
      ->remove('nomvoie')
      ->remove('complement')


      ->add('tel1','number',array(
        'mapped'=> false,
        'required'=>false,
        'attr'=>array('maxlength' => 2,'value'=>$telCar[0],),
      ))
      ->add('tel2','number',array(
        'mapped'=> false,
        'required'=>false,
        'attr'=>array('maxlength' => 2,'value'=>$telCar[1],),
      ))
      ->add('tel3','number',array(
        'mapped'=> false,
        'required'=>false,
        'attr'=>array('maxlength' => 2,'value'=>$telCar[2],),
      ))
      ->add('tel4','number',array(
        'mapped'=> false,
        'required'=>false,
        'attr'=>array('maxlength' => 2,'value'=>$telCar[3],),
      ))
      ->add('tel5','number',array(
        'mapped'=> false,
        'required'=>false,
        'attr'=>array('maxlength' => 2,'value'=>$telCar[4],),
      ))
      ->add('numerovoie','number',array(
        'mapped'=> false,
        'required'=>false,
        'attr'=>array('value'=>$rueCar[0],),
      ))
      ->add('typevoie','choice',array(
        'mapped'=> false,
        'required'=>false,

        'choices'=>array(
          'allée'=>'allée',
          'avenue'=>'avenue',
          'boulevard'=>'boulevard',
          'chaussée'=>'chaussée',
          'chemin'=>'chemin',
          'contre-allée'=>'contre-allée',
          'grand-route'=>'grand-route',
          'grand-rue'=>'grand-rue',
          'impasse'=>'impasse',
          'passage'=>'passage',
          'place'=>'place',
          'pont'=>'pont',
          'piste'=>'piste',
          'quai'=>'quai',
          'rocade'=>'rocade',
          'rond-point'=>'rond-point',
          'route'=>'route',
          'rue'=>'rue',
          'traverse'=>'traverse',
          'voie'=>'voie',
        ),
        'placeholder' => false,
        'preferred_choices' => array($rueCar[1]),
        'choices_as_values' => true,

      ))
      ->add('nomvoie','text',array(
        'mapped'=> false,
        'required'=>false,
        'attr'=>array('value'=>$rueCar[2],),
      ))
      ->add('complement','text',array(
        'mapped'=> false,
        'required'=>false,
        'attr'=>array('value'=>$rueCar[3],),
      ))
      ;

      if ($form->handleRequest($request)->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $data = $this->getRequest()->get('pl_facturationbundle_carnet');
        // TTT du nom  du prénom et de la ville
        $carnet->setNomCar(strtoupper($data['nomCar']));
        $carnet->setPrnCar(ucwords(strtolower($data['prnCar'])));
        $carnet->setVilCar(strtoupper($data['vilCar']));
        /// TTT de l'adresse (affectéé à rueCar en BDD)
        $carnet->setRueCar($data['numerovoie'].'*'.$data['typevoie'].'*'.$data['nomvoie'].'*'.$data['complement']);
        ///TTT téléphone
        $carnet->setTelCar($data['tel1'].'.'.$data['tel2'].'.'.$data['tel3'].'.'.$data['tel4'].'.'.$data['tel5']);

        $compte = $em->getRepository('PLFacturationBundle:Compte')->findCompteByCarnet($id);
        if (null === $compte) {
          throw new NotFoundHttpException("Compte introuvable");
        }
        $libelleCompte = "client ".$carnet->getNomCar()." ".$carnet->getPrnCar();
        $compte->setLibCom($libelleCompte);
        $em->flush();

        return $this->redirect($this->generateUrl('pl_facturation_carnet_index'));
      }

      return $this->render('PLFacturationBundle:Carnet:update.html.twig',array(
      'form'=>$form->createView()
      ));
  }
#####
  public function deleteAction($id){
    $em = $this->getDoctrine()->getManager();
    $carnet = $em->getRepository('PLFacturationBundle:Carnet')->find($id);
    // actualisation du compteur
    $compteur = $em->getRepository('PLFacturationBundle:Compteur')->find(1);
    $compteur->setCarCom($compteur->getCarCom()-1);
    $compte = $em->getRepository('PLFacturationBundle:Compte')->findCompteByCarnet($id);
    if (null === $compte) {
      throw new NotFoundHttpException("Compte introuvable");
    }
    $em->remove($carnet);
    $em->remove($compte);
    $em->flush();
    return $this->redirect($this->generateUrl('pl_facturation_carnet_client_index'));
}
#####
  public function clientIndexAction(){
    $em = $this->getDoctrine()->getManager();
    $rp = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('PLFacturationBundle:Carnet');
    $listCarnets = $rp->carnetStatutFilterRead('client');
    return $this->render('PLFacturationBundle:Carnet:clientindex.html.twig',array('listCarnets'=>$listCarnets));

  }
}
##END CONTROLLER
