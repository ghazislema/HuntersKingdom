<?php

namespace HuntersKingdomBundle\Controller;

use HuntersKingdomBundle\Entity\commande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use HuntersKingdomBundle\Entity\product;
use Symfony\Component\HttpFoundation\Response;


class commandeController extends Controller
{
    /**
     * Lists all commande entities.
     *
     * @Route("/api/commandes", name="commande_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commandes = $em->getRepository('HuntersKingdomBundle:commande')->findAll();

        $data=$this->get('jms_serializer')->serialize($commandes,'json');
        $response = new Response($data);
        return $response;
    }

    /**
     * Creates a new commande entity.
     *
     * @Route("/api/commandes/new", name="commande_new")
     * @Method({"POST"})
     */
    public function newAction(Request $request)
    {
        //récupérer le contenu de la requête envoyé par l'outil postman
        $data = $request->getContent();
        //deserialize data: création d'un objet 'produit' à partir des données json envoyées
        $commande = $this->get('jms_serializer') ->deserialize($data, 'HuntersKingdomBundle\Entity\commande', 'json');
        //ajout dans la base
        $em = $this->getDoctrine()->getManager();
        $em->persist($commande);
        $em->flush();
        return new View("Commande Added Successfully", Response::HTTP_OK);
    }

    /**
     * Finds and displays a commande entity.
     *
     * @Route("/api/commandes/{id}", name="commande_show")
     * @Method("GET")
     */
    public function showAction(commande $commande)
    {
        $data=$this->get('jms_serializer')->serialize($commande,'json');
        $response=new Response($data);
        return $response;
    }

    /**
     * Displays a form to validate an existing commande entity.
     *
     * @Route("/api/commandes/{id}/validate", name="commande_edit")
     * @Method({"PUT"})
     */
    public function editAction(Request $request, commande $commande)
    {
        $em=$this->getDoctrine()->getManager();
        $commande=$em->getRepository('HuntersKingdomBundle:commande')->find($commande->getId());
        $commande->setIsValid('true');
        $em->persist($commande);
        $em->flush();
        return new View("commande Modified Successfully", Response::HTTP_OK);
    }

    /**
     * Deletes a commande entity.
     *
     * @Route("/api/commandes/{id}/delete", name="commande_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, commande $commande)
    {
        $em=$this->getDoctrine()->getManager();
        $p=$em->getRepository('HuntersKingdomBundle:commande')->find($commande->getId());
        $em->remove($p);
        $em->flush();
        return new View("Commande Deleted Successfully", Response::HTTP_OK);
    }



}
