<?php

namespace HuntersKingdomBundle\Controller;

use FOS\RestBundle\View\View;
use HuntersKingdomBundle\Entity\categorie;
use HuntersKingdomBundle\Entity\Reservation;
use HuntersKingdomBundle\Form\ReservationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Reservation
 * @package HuntersKingdomBundle\Controller
 * @Route("Reservation")
 */
class ReservationController extends Controller
{
    public function indexAction()
    {
        return $this->render('HuntersKingdomBundle:Default:index.html.twig');
    }

    /**
     * Creates a new Reservation entity.
     *
     * @Route("/add", name="reservation_add")
     * @Method({"POST"})
     */
    public function bookAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class , $reservation);
        $form->submit($data);

        $event = $reservation->getEvent();

        $event->setPlaceDispo($event->getPlaceDispo() - 1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($reservation);
        $em->persist($event);
        $em->flush();
    }
    /**
     * Finds and displays a categorie entity.
     *
     * @Route("/get/{id}", name="reservation_get")
     * @Method("GET")
     */
    public function getAction(Reservation $reservation)
    {
        $data=$this->get('jms_serializer')->serialize($reservation,'json');
        $response=new Response($data);
        return $response;
    }

    /**
     * Finds and displays a categorie entity.
     *
     * @Route("/getall", name="reservation_getall")
     * @Method("GET")
     */
    public function getAllReservationAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reservation=$em->getRepository(Reservation::class)->findAll();
        $data=$this->get('jms_serializer')->serialize($reservation,'json');
        $response=new Response($data);
        return $response;
    }

    /**
     * Displays a form to edit an existing categorie entity.
     *
     * @Route("/update/{id}", name="categorie_update")
     * @Method({"GET", "POST"})
     */
    public function updateAction(Request $request, Reservation $reservation)
{
    $em=$this->getDoctrine()->getManager();
    $reservation=$em->getRepository('HuntersKingdomBundle:Reservation')->find($reservation->getId());
    $data=$request->getContent();
    $newdata=$this->get('jms_serializer')->deserialize($data,'HuntersKingdomBundle\Entity\Reservation','json');
    if($newdata->getNom() != null) {
        $reservation->setNom($newdata->getNom());
    }
    if($newdata->getPrenom!= null) {
        $reservation->setPrenom($newdata->getPrenom());
    }
    if($newdata->getTelephone!= null) {
        $reservation->setTelephone($newdata->getTelephone());
    }
    if($newdata->getEmail!= null) {
        $reservation->setEmail($newdata->getEmail());
    }
    if($newdata->getEvent!= null) {
        $reservation->setEvent($newdata->getEvent());
    }

    $em->persist($reservation);
    $em->flush();
    return new View("Categorie Modified Successfully", Response::HTTP_OK);
}

    /**
     * Deletes a categorie entity.
     *
     * @Route("/delete/{id}", name="reservation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Reservation $reservation)
    {

        $em=$this->getDoctrine()->getManager();
        $p=$em->getRepository('HuntersKingdomBundle:Reservation')->find($reservation->getId());
        $em->remove($p);
        $em->flush();
        return new View("Reservation Deleted Successfully", Response::HTTP_OK);

    }

}
