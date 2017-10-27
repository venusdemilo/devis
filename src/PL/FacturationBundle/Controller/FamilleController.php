<?php

namespace PL\FacturationBundle\Controller;
use PL\FacturationBundle\Entity\Famille;
use PL\FacturationBundle\Form\FamilleType;
use PL\FacturationBundle\Form\FamilleUpdateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
class FamilleController extends Controller
{
######
    public function indexAction()
    {
    	$rp = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('PLFacturationBundle:Famille');

    		$listFamilles = $rp->familleIndex();
    		if (null === $listFamilles) {
      		throw new NotFoundHttpException("La recherche a échoué");
    	}

        return $this->render('PLFacturationBundle:Famille:index.html.twig',array('listFamilles'=>$listFamilles));
    }
######
    public function createAction(Request $request){
    $famille = new Famille();
    $user = $this->getUser();
    $famille->setUser($user);
    $form = $this->get('form.factory')->create(new FamilleType, $famille);

    if ($form->handleRequest($request)->isValid()) {
    	$em = $this->getDoctrine()->getManager();
      $em->persist($famille);
      $em->flush();
      $request->getSession()->getFlashBag()->add('notice', 'Famille bien enregistrée.');
      return $this->redirect($this->generateUrl('pl_facturation_famille_index'));
    }

    return $this->render('PLFacturationBundle:Famille:new.html.twig',array(
    'form'=>$form->createView()
    ));

    }
######
	public function editAction(Request $request, $id){
		$em = $this->getDoctrine()->getManager();
    	$famille = $em->getRepository('PLFacturationBundle:Famille')->find($id);
    		if (null === $famille) {
      		throw new NotFoundHttpException("Impossible de créer l'entité");
    		}

   	$form = $this->get('form.factory')->create(new FamilleType, $famille);
    if ($form->handleRequest($request)->isValid()) {
    	$em = $this->getDoctrine()->getManager();
      $em->persist($famille);
      $em->flush();
    //$request->getSession()->getFlashBag()->add('notice', 'Famille bien modifiée.');
      return $this->redirect($this->generateUrl('pl_facturation_famille_index'));
    	}

   return $this->render('PLFacturationBundle:Famille:new.html.twig',array(
    'form'=>$form->createView()
    ));

	}
#####
	public function familleDeleteAction(Request $request, $id){
		$em = $this->getDoctrine()->getManager();
    	$famille = $em->getRepository('PLFacturationBundle:Famille')->find($id);
    		if (null === $famille) {
      		throw new NotFoundHttpException("Impossible de charger l'entité");
    		}
    	$em->remove($famille);
    	$em->flush();
    	$request->getSession()->getFlashBag()->add('warning', 'Famille supprimée.');
      return $this->redirect($this->generateUrl('pl_facturation_famille_index'));
    }
}##END CONTROLLER
