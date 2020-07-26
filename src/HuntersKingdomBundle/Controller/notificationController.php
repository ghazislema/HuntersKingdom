<?php

namespace HuntersKingdomBundle\Controller;

use FOS\RestBundle\View\View;
use HuntersKingdomBundle\Entity\notification;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class notificationController extends Controller
{
    /**
     * Creates a new notification entity.
     *
     * @Route("/api/notif/new", name="notif_new")
     * @Method({"POST"})
     */
    public function newNotif(Request $request)
    {
        //récupérer le contenu de la requête envoyé par l'outil postman
        $data = $request->getContent();
        //deserialize data: création d'un objet 'produit' à partir des données json envoyées
        $notification = $this->get('jms_serializer') ->deserialize($data, 'HuntersKingdomBundle\Entity\notification', 'json');
        //ajout dans la base
        $em = $this->getDoctrine()->getManager();
        $em->persist($notification);
        $em->flush();
        return new View("Notif Added Successfully", Response::HTTP_OK);
    }

}
