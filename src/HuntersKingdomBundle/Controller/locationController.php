<?php

namespace HuntersKingdomBundle\Controller;

use FOS\RestBundle\View\View;
use HuntersKingdomBundle\Entity\location;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class locationController extends Controller
{
    /**
     * @Route("/api/getall_locations")
     *
     */
    public function getallAction()
    {
        $em = $this->getDoctrine()->getManager();

        $locations = $em->getRepository('HuntersKingdomBundle:location')->findAll();

        $data=$this->get('jms_serializer')->serialize($locations,'json');
        $response = new Response($data);
        return $response;
    }

    /**
     * @Route("/api/getid_locationnnnnn/{id}")
     */
    public function getidAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $locations = $em->getRepository('HuntersKingdomBundle:location')->find($id);

        $data=$this->get('jms_serializer')->serialize($locations,'json');
        $response = new Response($data);
        return $response;
    }

    /**
     * @Route("/api/create_location",methods={"POST"})
     */
    public function creaateLOCAction(Request $request)
    {
        $data = $request->getContent();
        $location = $this->get('jms_serializer') ->deserialize($data, 'HuntersKingdomBundle\Entity\location', 'json');
        $em = $this->getDoctrine()->getManager();
        $em->persist($location);
        $em->flush();
        return new View("location Added", Response::HTTP_OK);
    }

    public function deleteAction(Request $request, location $location)
    {
        $em=$this->getDoctrine()->getManager();
        $p=$em->getRepository('HuntersKingdomBundle:product')->find($location->getId());
        $em->remove($p);
        $em->flush();
        return new View("location Deleted", Response::HTTP_OK);
    }


}
