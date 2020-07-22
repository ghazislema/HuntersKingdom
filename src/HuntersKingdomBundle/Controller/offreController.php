<?php

namespace HuntersKingdomBundle\Controller;

use FOS\RestBundle\View\View;
use HuntersKingdomBundle\Entity\offre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class offreController extends Controller
{
    /**
     * Lists all offre entities.
     *
     * @Route("/api/offres", name="offre_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $offreDemandes = $em->getRepository('HuntersKingdomBundle:offre')->findAll();

        $data=$this->get('jms_serializer')->serialize($offreDemandes,'json');
        $response = new Response($data);
        return $response;
    }

    /**
     * Creates a new offre entity.
     *
     * @Route("/api/offres/new", name="offre_add")
     * @Method({"GET", "POST"})
     */
    public function  addAction(Request $request)
    {
        //récupérer le contenu de la requête envoyé par l'outil postman
        $data = $request->getContent();
        //deserialize data: création d'un objet 'produit' à partir des données json envoyées
        dump($data);
        $offreDemande = $this->get('jms_serializer') ->deserialize($data, 'HuntersKingdomBundle\Entity\offre', 'json');
        //dump($produit);die;
        //ajout dans la base
        $em = $this->getDoctrine()->getManager();
        $em->persist($offreDemande);
        $em->flush();
        return new View("offre Added Successfully", Response::HTTP_OK);
    }

    /**
     * Finds and displays a offre entity.
     *
     * @Route("/api/offres/{id}", name="offre_get")
     * @Method("GET")
     */
    public function getAction(offre $offreDemande)
    {
        $data=$this->get('jms_serializer')->serialize($offreDemande,'json');
        $response=new Response($data);
        return $response;
    }

    /**
     * Displays a form to edit an existing offre entity.
     *
     * @Route("/api/offres/{id}/edit", name="offre_edit")
     * @Method({"PUT"})
     */
    public function updateAction(Request $request, offre $offreDemande)
    {
        $em=$this->getDoctrine()->getManager();
        $od=$em->getRepository('HuntersKingdomBundle:offre')->find($offreDemande->getId());
        $data=$request->getContent();
        $newdata=$this->get('jms_serializer')->deserialize($data,'HuntersKingdomBundle\Entity\offre','json');
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
        if($newdata->getIsValidated() != null) {
            $od->setIsValidated($newdata->getIsValidated());
        }

        $em->persist($od);
        $em->flush();
        return new View("offre Modified Successfully", Response::HTTP_OK);
    }
    /**
     * Finds and displays a offre entity.
     *
     * @Route("/api/offres/getall", name="offre_getall")
     * @Method("GET")
     */
    public function getAlloffreAction()
    {
        $em=$this->getDoctrine()->getManager();
        $offreDemande=$em->getRepository(offre::class)->findAll();
        $data=$this->get('jms_serializer')->serialize($offreDemande,'json');
        $response=new Response($data);
        return $response;
    }
    /**
     * Deletes a demande entity.
     *
     * @Route("/api/offres/{id}/delete", name="offre_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, offre $offreDemande)
    {
        $em = $this->getDoctrine()->getManager();
        $p = $em->getRepository('HuntersKingdomBundle:offre')->find($offreDemande->getId());
        $em->remove($p);
        $em->flush();
        return new View("offre Deleted Successfully", Response::HTTP_OK);

    }
}
