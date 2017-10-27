<?php

namespace PL\FacturationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PL\FacturationBundle\Entity\Famille;
use PL\FacturationBundle\Form\FamilleType;

/**
 * Famille controller.
 *
 * @Route("/famille")
 */
class FamilleController extends Controller
{

    /**
     * Lists all Famille entities.
     *
     * @Route("/", name="famille")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PLFacturationBundle:Famille')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Famille entity.
     *
     * @Route("/", name="famille_create")
     * @Method("POST")
     * @Template("PLFacturationBundle:Famille:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Famille();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('famille_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Famille entity.
     *
     * @param Famille $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Famille $entity)
    {
        $form = $this->createForm(new FamilleType(), $entity, array(
            'action' => $this->generateUrl('famille_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Famille entity.
     *
     * @Route("/new", name="famille_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Famille();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Famille entity.
     *
     * @Route("/{id}", name="famille_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PLFacturationBundle:Famille')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Famille entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Famille entity.
     *
     * @Route("/{id}/edit", name="famille_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PLFacturationBundle:Famille')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Famille entity.');
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
    * Creates a form to edit a Famille entity.
    *
    * @param Famille $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Famille $entity)
    {
        $form = $this->createForm(new FamilleType(), $entity, array(
            'action' => $this->generateUrl('famille_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Famille entity.
     *
     * @Route("/{id}", name="famille_update")
     * @Method("PUT")
     * @Template("PLFacturationBundle:Famille:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PLFacturationBundle:Famille')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Famille entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('famille_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Famille entity.
     *
     * @Route("/{id}", name="famille_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PLFacturationBundle:Famille')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Famille entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('famille'));
    }

    /**
     * Creates a form to delete a Famille entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('famille_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
