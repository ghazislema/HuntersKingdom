<?php

namespace HuntersKingdomBundle\Controller;

use FOS\RestBundle\View\View;
use HuntersKingdomBundle\Entity\sell;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;

class sellController extends Controller
{
    /**
     * Lists all produit entities.
     *
     * @Route("/api/sells", name="sell_index")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('HuntersKingdomBundle:sell')->findAll();

        $data=$this->get('jms_serializer')->serialize($produits,'json');
        $response = new Response($data);
        return $response;
    }

    /**
     * Creates a new produit entity.
     *
     * @Route("/api/sell/new", name="sell_new")
     * @Method({"POST"})
     */
    public function newAction(Request $request)
    {
        //récupérer le contenu de la requête envoyé par l'outil postman
        $data = $request->getContent();
        //deserialize data: création d'un objet 'produit' à partir des données json envoyées
        $produit = $this->get('jms_serializer') ->deserialize($data, 'HuntersKingdomBundle\Entity\sell', 'json');
        //ajout dans la base
        $em = $this->getDoctrine()->getManager();
        $em->persist($produit);
        $em->flush();
        return new View("demande Added Successfully", Response::HTTP_OK);
    }

    /**
     * Finds and displays a produit entity.
     *
     * @Route("/api/sell/{id}", name="sell_show")
     * @Method({"GET"})
     */
    public function showAction(sell $produit)
    {
        $data=$this->get('jms_serializer')->serialize($produit,'json');
        $response=new Response($data);
        return $response;
    }

    /**
     * Displays a form to edit an existing produit entity.
     *
     * @Route("/api/sell/{id}/edit", name="sell_edit")
     * @Method({"PUT"})
     */
    public function editAction(Request $request, sell $produit)
    {
        $em=$this->getDoctrine()->getManager();
        $produit=$em->getRepository('HuntersKingdomBundle:sell')->find($produit->getId());
        $data=$request->getContent();
        $newdata=$this->get('jms_serializer')->deserialize($data,'HuntersKingdomBundle\Entity\sell','json');
        if($newdata->getTitre() != null) {
            $produit->setTitre($newdata->getTitre());
        }
        if($newdata->getAdresse() != null) {
            $produit->setAdresse($newdata->getAdresse());
        }
        if($newdata->getDeadline() != null) {
            $produit->setDeadline($newdata->getDeadline());
        }
        if($newdata->getDatePublication() != null) {
            $produit->setDatePublication($newdata->getDatePublication());
        }
        if($newdata->getDescription() != null) {
            $produit->setDescription($newdata->getDescription());
        }
        if($newdata->getEtat() != null) {
            $produit->setEtat($newdata->getEtat());
        }
        if($newdata->getCategorie() != null) {
            $produit->setCategorie($newdata->getCategorie());
        }
        $em->persist($produit);
        $em->flush();
        return new View("demande Modified Successfully", Response::HTTP_OK);
    }

    /**
     * Deletes a produit entity.
     *
     * @Route("/api/sell/{id}/delete", name="sell_delete")
     * @Method({"DELETE"})
     */
    public function deleteAction(Request $request, sell $produit)
    {
        $em=$this->getDoctrine()->getManager();
        $p=$em->getRepository('HuntersKingdomBundle:sell')->find($produit->getId());
        $em->remove($p);
        $em->flush();
        return new View("demande Deleted Successfully", Response::HTTP_OK);
    }

    public function sellByCategorieAction(Request $request, sell $produit)
    {
        $em=$this->getDoctrine()->getManager();
        $p=$em->getRepository('HuntersKingdomBundle:sell')->findBy(array('categorie' => $produit->getCategorie()));
        $data=$this->get('jms_serializer')->serialize($p,'json');
        $response=new Response($data);
        return $response;
    }

}
