<?php

namespace HuntersKingdomBundle\Controller;

use FOS\RestBundle\View\View;
use HuntersKingdomBundle\Entity\demande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class demandeController extends Controller
{
    /**
     * Lists all demande entities.
     *
     * @Route("/api/demandes", name="demande_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $offreDemandes = $em->getRepository('HuntersKingdomBundle:demande')->findAll();

        $data=$this->get('jms_serializer')->serialize($offreDemandes,'json');
        $response = new Response($data);
        return $response;
    }

    /**
     * Creates a new demande entity.
     *
     * @Route("/api/demandes/new", name="demande_add")
     * @Method({"GET", "POST"})
     */
    public function  addAction(Request $request)
    {
        //récupérer le contenu de la requête envoyé par l'outil postman
        $data = $request->getContent();
        //deserialize data: création d'un objet 'produit' à partir des données json envoyées
        dump($data);
        $offreDemande = $this->get('jms_serializer') ->deserialize($data, 'HuntersKingdomBundle\Entity\demande', 'json');
        //dump($produit);die;
        //ajout dans la base
        $em = $this->getDoctrine()->getManager();
        $em->persist($offreDemande);
        $em->flush();
        return new View("Demande Added Successfully", Response::HTTP_OK);
    }

    /**
     * Finds and displays a demande entity.
     *
     * @Route("/api/demandes/{id}", name="demande_get")
     * @Method("GET")
     */
    public function getAction(demande $offreDemande)
    {
        $data=$this->get('jms_serializer')->serialize($offreDemande,'json');
        $response=new Response($data);
        return $response;
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     * @Route("/api/demandes/{id}/edit", name="demande_edit")
     * @Method({"PUT"})
     */
    public function updateAction(Request $request, demande $offreDemande)
    {
        $em=$this->getDoctrine()->getManager();
        $od=$em->getRepository('HuntersKingdomBundle:demande')->find($offreDemande->getId());
        $data=$request->getContent();
        $newdata=$this->get('jms_serializer')->deserialize($data,'HuntersKingdomBundle\Entity\demande','json');
        if($newdata->getTitre() != null) {
            $od->getTitre($newdata->getTitre());
        }
        if($newdata->getType() != null) {
            $od->setType($newdata->getType());
        }
        if($newdata->getadresse() != null) {
            $od->setAdresse($newdata->getadresse());
        }
        if($newdata->getDeadline() != null) {
            $od->setDeadline($newdata->getDeadline());
        }
        if($newdata->getDatePublication() != null) {
            $od->setDatePublication($newdata->getDatePublication());
        }
        if($newdata->getDescription() != null) {
            $od->setDescription($newdata->getDescription());
        }
        if($newdata->getEtat() != null) {
            $od->setEtat($newdata->getEtat());
        }
        if($newdata->getCategorie() != null) {
            $od->setCategorie($newdata->getCategorie());
        }

        $em->persist($od);
        $em->flush();
        return new View("Demande Modified Successfully", Response::HTTP_OK);
    }
    /**
     * Finds and displays a demande entity.
     *
     * @Route("/api/demandes/getall", name="Demande_getall")
     * @Method("GET")
     */
    public function getAllDemandeAction()
    {
        $em=$this->getDoctrine()->getManager();
        $offreDemande=$em->getRepository(demande::class)->findAll();
        $data=$this->get('jms_serializer')->serialize($offreDemande,'json');
        $response=new Response($data);
        return $response;
    }
     /**
     * Deletes a demande entity.
     *
     * @Route("/api/demandes/{id}/delete", name="Demande_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, demande $offreDemande)
    {
        $em = $this->getDoctrine()->getManager();
        $p = $em->getRepository('HuntersKingdomBundle:demande')->find($offreDemande->getId());
        $em->remove($p);
        $em->flush();
        return new View("Demande Deleted Successfully", Response::HTTP_OK);

    }
}
