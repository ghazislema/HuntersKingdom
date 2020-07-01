<?php

namespace HuntersKingdomBundle\Controller;

use FOS\RestBundle\View\View;
use HuntersKingdomBundle\Entity\event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Event controller.
 *
 * @Route("event")
 */
class eventController extends Controller
{
    /**
     * Lists all event entities.
     *
     * @Route("/", name="event_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('HuntersKingdomBundle:event')->findAll();

        return $this->render('event/index.html.twig', array(
            'events' => $events,
        ));
    }

    /**
     * Creates a new event entity.
     *
     * @Route("/add", name="event_add")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        //récupérer le contenu de la requête envoyé par l'outil postman
        $data = $request->getContent();
        //deserialize data: création d'un objet 'produit' à partir des données json envoyées
        $produit = $this->get('jms_serializer') ->deserialize($data, 'HuntersKingdomBundle\Entity\event', 'json');
        //ajout dans la base
        $em = $this->getDoctrine()->getManager();
        $em->persist($produit);
        $em->flush();
        return new View("Event Added Successfully", Response::HTTP_OK);
    }

    /**
     * Finds and displays a event entity.
     *
     * @Route("/get/{id}", name="event_get")
     * @Method("GET")
     */
    public function getAction(event $event)
    {
        $data=$this->get('jms_serializer')->serialize($event,'json');
        $response=new Response($data);
        return $response;
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     * @Route("/addd/{id}", name="event_edit")
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request, event $event)
    {
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository('HuntersKingdomBundle:event')->find($event->getId());
        $data=$request->getContent();
        $newdata=$this->get('jms_serializer')->deserialize($data,'HuntersKingdomBundle\Entity\event','json');
        if($newdata->getNom() != null) {
            $event->setNom($newdata->geNom());
        }
        if($newdata->getType() != null) {
            $event->setType($newdata->getType());
        }
        if($newdata->getadresse() != null) {
            $event->setAdresse($newdata->getadresse());
        }
        if($newdata->getLatitude() != null) {
            $event->setLatitude($newdata->getLatitude());
        }
        if($newdata->getLangitude() != null) {
            $event->setLangitude($newdata->getLangitude());
        }
        if($newdata->getDateDebut() != null) {
            $event->setDateDebut($newdata->getDateDebut());
        }
        if($newdata->getDateFin() != null) {
            $event->setDateFin($newdata->getDateFin());
        }
        if($newdata->getNbrParticipent() != null) {
            $event->setNbrParticipent($newdata->getNbrParticipent());
        }
        if($newdata->getPlaceDispo() != null) {
            $event->setPlaceDispo($newdata->getPlaceDispo());
        }

        $em->persist($event);
        $em->flush();
        return new View("Event Modified Successfully", Response::HTTP_OK);
    }

    /**
     * Deletes a event entity.
     *
     * @Route("/{id}", name="event_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, event $event)
    {
        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
        }

        return $this->redirectToRoute('event_index');
    }


}
