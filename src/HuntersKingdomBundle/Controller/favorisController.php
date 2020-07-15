<?php

namespace HuntersKingdomBundle\Controller;

use HuntersKingdomBundle\Entity\favoris;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use HuntersKingdomBundle\Entity\commande;
use FOS\RestBundle\View\View;
use HuntersKingdomBundle\Entity\product;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;


class favorisController extends Controller
{
    /**
     * Lists all favori entities.
     *
     * @Route("/api/favoris", name="favoris_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $favoris = $em->getRepository('HuntersKingdomBundle:favoris')->findAll();

        $data=$this->get('jms_serializer')->serialize($favoris,'json');
        $response = new Response($data);
        return $response;
    }

    /**
     * Creates a new favori entity.
     *
     * @Route("/api/favoris/new", name="favoris_new")
     * @Method({"POST"})
     */
    public function newAction(Request $request)
    {
        //récupérer le contenu de la requête envoyé par l'outil postman
        $data = $request->getContent();
        //deserialize data: création d'un objet 'favoris' à partir des données json envoyées
        $favoris = $this->get('jms_serializer') ->deserialize($data, 'HuntersKingdomBundle\Entity\favoris', 'json');
        //ajout dans la base
        $em = $this->getDoctrine()->getManager();
        $x = $em->merge($favoris);
        $em->persist($x);
        $em->flush();
        return new View("Favoris Added Successfully", Response::HTTP_OK);
    }

    /**
     * Finds and displays a favori entity.
     *
     * @Route("/api/favoris/{id}", name="favoris_show")
     * @Method("GET")
     */
    public function showAction(favoris $favori)
    {
        $data=$this->get('jms_serializer')->serialize($favori,'json');
        $response=new Response($data);
        return $response;
    }

    /**
     * Displays a form to edit an existing favori entity.
     *
     * @Route("/api/commandes/{id}/edit", name="favoris_edit")
     * @Method({"PUT"})
     */
    public function editAction(Request $request, favoris $favori)
    {
        return new View("favoris Can't Be Modified", Response::HTTP_OK);

    }

    /**
     * Deletes a favori entity.
     *
     * @Route("/api/favoris/{id}/delete", name="favoris_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, favoris $favori)
    {
        $em=$this->getDoctrine()->getManager();
        $p=$em->getRepository('HuntersKingdomBundle:favoris')->find($favori->getId());
        $em->remove($p);
        $em->flush();
        return new View("Favoris Deleted Successfully", Response::HTTP_OK);
    }


    /**
     * search favoris by user id.
     * @Get("/api/favoris/{user}/products")
     *
     */
    public function favorisByUserAction(Request $request, favoris $favori)
    {
        $em=$this->getDoctrine()->getManager();
        $p=$em->getRepository('HuntersKingdomBundle:favoris')->findBy(array('user' => $favori->getUser()));
        $data=$this->get('jms_serializer')->serialize($p,'json');
        $response=new Response($data);
        return $response;
    }
}
