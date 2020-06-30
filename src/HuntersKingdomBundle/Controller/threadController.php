<?php

namespace HuntersKingdomBundle\Controller;


use HuntersKingdomBundle\Entity\thread;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Thread controller.
 *
 * @Route("thread")
 */
class threadController extends Controller
{
    /**
     * Lists all thread entities.
     *
     * @Route("/", name="thread_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $threads = $em->getRepository('HuntersKingdomBundle:thread')->findAll();

        $data=$this->get('jms_serializer')->serialize($threads,'json');
        $response = new Response($data);
        return $response;
    }

    /**
     * Creates a new thread entity.
     *
     * @Route("/new", name="thread_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        $data = $request->getContent();
        //deserialize data: création d'un objet 'produit' à partir des données json envoyées
        $thread = $this->get('jms_serializer') ->deserialize($data, 'HuntersKingdomBundle\Entity\thread', 'json');
        //ajout dans la base
        $em = $this->getDoctrine()->getManager();
        $em->persist($thread);
        $em->flush();
        return new View("Thread Added Successfully", Response::HTTP_OK);
    }

    /**
     * Finds and displays a thread entity.
     *
     * @Route("/{id}", name="thread_show")
     * @Method("GET")
     */
    public function showAction(thread $thread)
    {
        $data=$this->get('jms_serializer')->serialize($thread,'json');
        $response=new Response($data);
        return $response;
    }

    /**
     * Displays a form to edit an existing thread entity.
     *
     * @Route("/{id}/edit", name="thread_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, thread $thread)
    {
        $em=$this->getDoctrine()->getManager();
        $thread=$em->getRepository('HuntersKingdomBundle:thread')->find($thread->getId());
        $data=$request->getContent();
        $newdata=$this->get('jms_serializer')->deserialize($data,'HuntersKingdomBundle\Entity\thread','json');
        if($newdata->getTitle() != null) {
            $thread->setTitle($newdata->getTitle());
        }
        if($newdata->getDescription() != null) {
            $thread->setDescription($newdata->getDescription());
        }
        if($newdata->getUpvote() != null) {
            $thread->setUpvote($newdata->getUpvote());
        }
        if($newdata->getDownvote() != null) {
            $thread->setDownvote($newdata->getDownvote());
        }
        $em->persist($thread);
        $em->flush();
        return new View("Product Modified Successfully", Response::HTTP_OK);
    }

    /**
     * Deletes a thread entity.
     *
     * @Route("/{id}", name="thread_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, thread $thread)
    {
        $em=$this->getDoctrine()->getManager();
        $p=$em->getRepository('HuntersKingdomBundle:thread')->find($thread->getId());
        $em->remove($p);
        $em->flush();
        return new View("Thread Deleted Successfully", Response::HTTP_OK);
    }


}
