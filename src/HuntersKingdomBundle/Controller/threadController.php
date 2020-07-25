<?php

namespace HuntersKingdomBundle\Controller;

use HuntersKingdomBundle\Entity\overwatch;
use HuntersKingdomBundle\Entity\product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\View\View;
use HuntersKingdomBundle\Entity\thread;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class threadController extends Controller
{
    /**
     * Lists all thread entities.
     *
     * @Route("/api/threads", name="thread_index")
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
     * @Route("/api/threads/new", name="thread_newx")
     * @Method({"POST"})
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
     * @Route("/api/threads/{id}", name="thread_show")
     * @Method("GET")
     */
    public function showAction(thread $thread)
    {
        $data=$this->get('jms_serializer')->serialize($thread,'json');
        $response=new Response($data);
        return $response;
    }

    /**
     * Deletes a produit entity.
     *
     * @Route("/api/threads/{id}/delete", name="thread_delete")
     * @Method({"DELETE"})
     */
    public function deleteAction(Request $request, thread $thread)
    {
        $em=$this->getDoctrine()->getManager();
        $p=$em->getRepository('HuntersKingdomBundle:thread')->find($thread->getId());
        $em->remove($p);
        $em->flush();
        return new View("Thread Deleted Successfully", Response::HTTP_OK);
    }

    /**
     * Lists all thread entities.
     *
     * @Route("/api/threadsvalid", name="validthread_index")
     * @Method("GET")
     */
    public function findValidThreads()
    {
        $em = $this->getDoctrine()->getManager();
        $threads = $em->getRepository('HuntersKingdomBundle:thread')->findBy(['isValidated' => 'true' ]);
        $data=$this->get('jms_serializer')->serialize($threads,'json');
        $response = new Response($data);
        return $response;
    }


    /**
     * Lists all thread entities.
     *
     * @Route("/api/threadstovalidate", name="toValidthread_index")
     * @Method("GET")
     */
    public function findThreadsToValidate()
    {
        $em = $this->getDoctrine()->getManager();
        $threads = $em->getRepository('HuntersKingdomBundle:thread')->findBy(['isValidated' => 'false' ]);
        $data=$this->get('jms_serializer')->serialize($threads,'json');
        $response = new Response($data);
        return $response;
    }

    /**
     * Deletes a produit entity.
     *
     * @Route("/api/threads/{id}/validate", name="thread_validate")
     * @Method({"DELETE"})
     */
    public function validateThread(Request $request, thread $thread)
    {
        $em=$this->getDoctrine()->getManager();
        $thread=$em->getRepository('HuntersKingdomBundle:thread')->find($thread->getId());
        $thread->setIsValidated("true");
        $em->persist($thread);
        $em->flush();
        return new View("Thread validated Successfully", Response::HTTP_OK);
    }











}
