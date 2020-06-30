<?php

namespace HuntersKingdomBundle\Controller;

use HuntersKingdomBundle\Entity\threaddetail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Threaddetail controller.
 *
 * @Route("threaddetail")
 */
class threaddetailController extends Controller
{
    /**
     * Lists all threaddetail entities.
     *
     * @Route("/", name="threaddetail_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $threaddetails = $em->getRepository('HuntersKingdomBundle:threaddetail')->findAll();

        return $this->render('threaddetail/index.html.twig', array(
            'threaddetails' => $threaddetails,
        ));
    }

    /**
     * Creates a new threaddetail entity.
     *
     * @Route("/new", name="threaddetail_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $threaddetail = new Threaddetail();
        $form = $this->createForm('HuntersKingdomBundle\Form\threaddetailType', $threaddetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($threaddetail);
            $em->flush();

            return $this->redirectToRoute('threaddetail_show', array('id' => $threaddetail->getId()));
        }

        return $this->render('threaddetail/new.html.twig', array(
            'threaddetail' => $threaddetail,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a threaddetail entity.
     *
     * @Route("/{id}", name="threaddetail_show")
     * @Method("GET")
     */
    public function showAction(threaddetail $threaddetail)
    {
        $deleteForm = $this->createDeleteForm($threaddetail);

        return $this->render('threaddetail/show.html.twig', array(
            'threaddetail' => $threaddetail,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing threaddetail entity.
     *
     * @Route("/{id}/edit", name="threaddetail_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, threaddetail $threaddetail)
    {
        $deleteForm = $this->createDeleteForm($threaddetail);
        $editForm = $this->createForm('HuntersKingdomBundle\Form\threaddetailType', $threaddetail);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('threaddetail_edit', array('id' => $threaddetail->getId()));
        }

        return $this->render('threaddetail/edit.html.twig', array(
            'threaddetail' => $threaddetail,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a threaddetail entity.
     *
     * @Route("/{id}", name="threaddetail_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, threaddetail $threaddetail)
    {
        $form = $this->createDeleteForm($threaddetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($threaddetail);
            $em->flush();
        }

        return $this->redirectToRoute('threaddetail_index');
    }

    /**
     * Creates a form to delete a threaddetail entity.
     *
     * @param threaddetail $threaddetail The threaddetail entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(threaddetail $threaddetail)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('threaddetail_delete', array('id' => $threaddetail->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
