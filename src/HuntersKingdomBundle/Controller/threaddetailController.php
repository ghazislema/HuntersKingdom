<?php

namespace HuntersKingdomBundle\Controller;

use HuntersKingdomBundle\Entity\thread;
use HuntersKingdomBundle\Entity\threaddetail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class threaddetailController extends Controller
{
    /**
     * Lists all threaddetail entities.
     *
     * @Route("/api/threadcomments", name="threaddetail_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $threaddetail = $em->getRepository('HuntersKingdomBundle:threaddetail')->findAll();

        $data=$this->get('jms_serializer')->serialize($threaddetail,'json');
        $response = new Response($data);
        return $response;
    }

    /**
     * Creates a new threaddetail entity.
     *
     * @Route("/new", name="threaddetail_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $data = $request->getContent();
        $threaddetail = $this->get('jms_serializer') ->deserialize($data, 'HuntersKingdomBundle\Entity\threaddetail', 'json');
        $em = $this->getDoctrine()->getManager();
        $em->persist($threaddetail);
        $em->flush();
        return new View("ThreadDetail Added Successfully", Response::HTTP_OK);
    }

    /**
     * Finds and displays a threaddetail entity.
     *
     * @Route("/{id}", name="threaddetail_show")
     * @Method("GET")
     */
    public function showAction(threaddetail $threaddetail)
    {
        $data=$this->get('jms_serializer')->serialize($threaddetail,'json');
        $response=new Response($data);
        return $response;
    }

    /**
     * Displays a form to edit an existing threaddetail entity.
     *
     * @Route("/{id}/edit", name="threaddetail_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, threaddetail $threaddetail)
    {
        $em=$this->getDoctrine()->getManager();
        $data=$request->getContent();
        $newdata=$this->get('jms_serializer')->deserialize($data,'HuntersKingdomBundle\Entity\threaddetail','json');
        $em->persist($newdata);
        $em->flush();
        return new View("Threaddetail Modified Successfully", Response::HTTP_OK);
    }

    /**
     * Deletes a threaddetail entity.
     *
     * @Route("/{id}", name="threaddetail_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, threaddetail $threaddetail)
    {

        $em=$this->getDoctrine()->getManager();
        $p=$em->getRepository('HuntersKingdomBundle:threaddetail')->find($threaddetail->getId());
        $em->remove($p);
        $em->flush();
        return new View("ThreadDetail Deleted Successfully", Response::HTTP_OK);
    }

    /**
     * retrieve  details entitie of a thread
     *
     * @Route("/api/threadcomments/{id}", name="threadetail_getindex")
     * @Method("GET")
     */
    public function findThreadsToValidate(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $threads = $em->getRepository('HuntersKingdomBundle:threaddetail')->findBy(['threadid' => $id ]);
        $data=$this->get('jms_serializer')->serialize($threads,'json');
        $response = new Response($data);
        return $response;
    }




}
