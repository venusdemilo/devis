<?php

namespace PL\FacturationBundle\Controller;
use PL\FacturationBundle\Entity\Produit;
use PL\FacturationBundle\Entity\Famille;
use PL\FacturationBundle\Entity\Infoproduit;
use PL\FacturationBundle\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
class ProduitController extends Controller
{
######
    public function indexAction()
    {
    	$rp = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('PLFacturationBundle:Produit')
        ;
    		$listProduits = $rp->produitIndex();
    		if (null === $listProduits) {
      		throw new NotFoundHttpException("La recherche a échoué");
    	}
        return $this->render('PLFacturationBundle:Produit:index.html.twig',array('listProduits'=>$listProduits));
    }

######
  public function newAction(Request $request)
  {
    $produit = new Produit();
    $user = $this->getUser();
    $produit->setUser($user);
    $form = $this->get('form.factory')->create(new ProduitType, $produit);
    $form->add('famille','entity',array(
          'class' => 'PLFacturationBundle:Famille',
          'property' => 'libFam',
          'multiple' => false,
          'required' =>true,
          'mapped' =>true,
          'empty_value' => 'Famille'
          )
        )
        ->add('Enregistrer','submit');
    if ($form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();

      $em->persist($produit);
      $em->flush();
      $request->getSession()->getFlashBag()->add('info', 'Nouveau produit enregistrée.');
      return $this->redirect($this->generateUrl('pl_facturation_produit_index'));
    }
    return $this->render('PLFacturationBundle:Produit:new.html.twig',array(
    'form'=>$form->createView()
    ));
  }
#####
  public function editAction(Request $request, $id){
    $em= $this->getDoctrine()->getManager();
    $produit = $em->getRepository('PLFacturationBundle:Produit')->find($id);
    //$rp = $em->getRepository('PLFacturationBundle:Produit');
    //$produit =$rp->produitById($id);

    if (null === $produit) {
      throw new NotFoundHttpException("La recherche a échoué");
    }
    $form = $this->get('form.factory')->create(new ProduitType, $produit);
    $form->add('famille','entity',array(
          'class' => 'PLFacturationBundle:Famille',
          'property' => 'libFam',
          'multiple' => false,
          'required' =>true,
          'mapped' =>true,
          'empty_value' => 'Famille'
          )
        )
        ->add('Enregistrer','submit');

    if ($form->handleRequest($request)->isValid()) {
      $em->persist($produit);
      $em->flush();
      $request->getSession()->getFlashBag()->add('success', 'Produit modifié.');
      return $this->redirect($this->generateUrl('pl_facturation_produit_index'));
    }
    return $this->render('PLFacturationBundle:Produit:new.html.twig', array ('form' =>$form->createView()));
  }
#####
  public function deleteAction(Request $request, $id){
    $em = $this->getDoctrine()->getManager();
    $produit = $em->getRepository('PLFacturationBundle:Produit')->find($id);
    if (null === $produit) {
      throw new NotFoundHttpException("La recherche a échoué");
    }
    $em->remove($produit);
    $em->flush();
    $request->getSession()->getFlashBag()->add('warning', 'Produit supprimé.');
    return $this->redirect($this->generateUrl('pl_facturation_produit_index'));

  }
#####
  public function produitDevisCreateAction(){
    $em = $this->getDoctrine()->getManager();
    $rp = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('PLFacturationBundle:Produit');
    $listProduits = $rp->produitDevisCreate();
    return $this->render('PLFacturationBundle:Produit:devisCreate.html.twig',array('listProduits'=>$listProduits));

  }
}##END CONTROLLER
