<?php

namespace HuntersKingdomBundle\Controller;

use FOS\RestBundle\View\View;
use HuntersKingdomBundle\Entity\product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class productController extends Controller
{
    /**
     * Lists all produit entities.
     *
     * @Route("/api/produits", name="produit_index")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('HuntersKingdomBundle:product')->findAll();

        $data=$this->get('jms_serializer')->serialize($produits,'json');
        $response = new Response($data);
        return $response;
    }

    /**
     * Creates a new produit entity.
     *
     * @Route("/api/produits/new", name="produit_new")
     * @Method({"POST"})
     */
    public function newAction(Request $request)
    {
        //récupérer le contenu de la requête envoyé par l'outil postman
        $data = $request->getContent();
        //deserialize data: création d'un objet 'produit' à partir des données json envoyées
        $produit = $this->get('jms_serializer') ->deserialize($data, 'HuntersKingdomBundle\Entity\product', 'json');
        //ajout dans la base
        $em = $this->getDoctrine()->getManager();
        $em->persist($produit);
        $em->flush();
        return new View("Product Added Successfully", Response::HTTP_OK);
    }

    /**
     * Finds and displays a produit entity.
     *
     * @Route("/api/produits/{id}", name="produit_show")
     * @Method({"GET"})
     */
    public function showAction(product $produit)
    {
        $data=$this->get('jms_serializer')->serialize($produit,'json');
        $response=new Response($data);
        return $response;
    }

    /**
     * Displays a form to edit an existing produit entity.
     *
     * @Route("/api/produits/{id}/edit", name="produit_edit")
     * @Method({"PUT"})
     */
    public function editAction(Request $request, product $produit)
    {
        $em=$this->getDoctrine()->getManager();
        $produit=$em->getRepository('HuntersKingdomBundle:product')->find($produit->getId());
        $data=$request->getContent();
        $newdata=$this->get('jms_serializer')->deserialize($data,'HuntersKingdomBundle\Entity\product','json');
        if($newdata->getPrix() != null) {
            $produit->setPrix($newdata->getPrix());
        }
        if($newdata->getDescription() != null) {
            $produit->setDescription($newdata->getDescription());
        }
        if($newdata->getLibelle() != null) {
            $produit->setLibelle($newdata->getLibelle());
        }
        if($newdata->getCategorie() != null) {
            $produit->setCategorie($newdata->getCategorie());
        }
        if($newdata->getDate() != null) {
            $produit->setDate($newdata->getDate());
        }
        if($newdata->getImage() != null) {
            $produit->setImage($newdata->getImage());
        }
        if($newdata->getType() != null) {
            $produit->setType($newdata->getType());
        }
        if($newdata->getQuantite() != null) {
            $produit->setQuantite($newdata->getQuantite());
        }
        $em->persist($produit);
        $em->flush();
        return new View("Product Modified Successfully", Response::HTTP_OK);
    }

    /**
     * Deletes a produit entity.
     *
     * @Route("/api/produits/{id}/delete", name="produit_delete")
     * @Method({"DELETE"})
     */
    public function deleteAction(Request $request, product $produit)
    {
        $em=$this->getDoctrine()->getManager();
        $p=$em->getRepository('HuntersKingdomBundle:product')->find($produit->getId());
        $em->remove($p);
        $em->flush();
        return new View("Product Deleted Successfully", Response::HTTP_OK);
    }
}
