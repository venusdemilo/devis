<?php

namespace PL\FacturationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PL\FacturationBundle\Entity\Infoproduit;
use PL\FacturationBundle\Form\InfoproduitType;

/**
 * Infoproduit controller.
 *
 * @Route("/infoproduit")
 */
class InfoproduitController extends Controller
{

    /**
     * Lists all Infoproduit entities.
     *
     * @Route("/", name="infoproduit")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PLFacturationBundle:Infoproduit')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Infoproduit entity.
     *
     * @Route("/", name="infoproduit_create")
     * @Method("POST")
     * @Template("PLFacturationBundle:Infoproduit:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Infoproduit();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('infoproduit_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Infoproduit entity.
     *
     * @param Infoproduit $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Infoproduit $entity)
    {
        $form = $this->createForm(new InfoproduitType(), $entity, array(
            'action' => $this->generateUrl('infoproduit_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Infoproduit entity.
     *
     * @Route("/new", name="infoproduit_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Infoproduit();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Infoproduit entity.
     *
     * @Route("/{id}", name="infoproduit_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PLFacturationBundle:Infoproduit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Infoproduit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Infoproduit entity.
     *
     * @Route("/{id}/edit", name="infoproduit_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PLFacturationBundle:Infoproduit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Infoproduit entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Infoproduit entity.
    *
    * @param Infoproduit $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Infoproduit $entity)
    {
        $form = $this->createForm(new InfoproduitType(), $entity, array(
            'action' => $this->generateUrl('infoproduit_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Infoproduit entity.
     *
     * @Route("/{id}", name="infoproduit_update")
     * @Method("PUT")
     * @Template("PLFacturationBundle:Infoproduit:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PLFacturationBundle:Infoproduit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Infoproduit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('infoproduit_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Infoproduit entity.
     *
     * @Route("/{id}", name="infoproduit_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PLFacturationBundle:Infoproduit')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Infoproduit entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('infoproduit'));
    }

    /**
     * Creates a form to delete a Infoproduit entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('infoproduit_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
