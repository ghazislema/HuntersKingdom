<?php

namespace HuntersKingdomBundle\Controller;

use FOS\RestBundle\View\View;
use HuntersKingdomBundle\Entity\categorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Categorie controller.
 *
 * @Route("categorie")
 */
class categorieController extends Controller
{
    /**
     * Lists all categorie entities.
     *
     * @Route("/", name="categorie_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('HuntersKingdomBundle:categorie')->findAll();

        return $this->render('categorie/index.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * Creates a new categorie entity.
     *
     * @Route("/add", name="categorie_add")
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
        {
            //récupérer le contenu de la requête envoyé par l'outil postman
            $data = $request->getContent();
            //deserialize data: création d'un objet 'produit' à partir des données json envoyées
            $categorie = $this->get('jms_serializer') ->deserialize($data, 'HuntersKingdomBundle\Entity\categorie', 'json');
            //ajout dans la base
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            return new View("Categorie Added Successfully", Response::HTTP_OK);
        }



    /**
     * Finds and displays a categorie entity.
     *
     * @Route("/get/{id}", name="categorie_get")
     * @Method("GET")
     */
    public function getAction(categorie $categorie)
    {
        $data=$this->get('jms_serializer')->serialize($categorie,'json');
        $response=new Response($data);
        return $response;
    }

    /**
     * Finds and displays a categorie entity.
     *
     * @Route("/getall", name="categorie_getall")
     * @Method("GET")
     */
    public function getAllCategorieAction()
    {
        $em=$this->getDoctrine()->getManager();
        $categorie=$em->getRepository(categorie::class)->findAll();
        $data=$this->get('jms_serializer')->serialize($categorie,'json');
        $response=new Response($data);
        return $response;
    }

    /**
     * Displays a form to edit an existing categorie entity.
     *
     * @Route("/update/{id}", name="categorie_edit")
     * @Method({"PUT"})
     */
    public function updateAction(Request $request, categorie $categorie)
    {
        $em=$this->getDoctrine()->getManager();
        $categorie=$em->getRepository('HuntersKingdomBundle:categorie')->find($categorie->getId());
        $data=$request->getContent();
        $newdata=$this->get('jms_serializer')->deserialize($data,'HuntersKingdomBundle\Entity\categorie','json');
        if($newdata->getNom() != null) {
            $categorie->setNom($newdata->getNom());
        }
        if($newdata->getDescription!= null) {
            $categorie->setDescription($newdata->getDescription());
        }

        $em->persist($categorie);
        $em->flush();
        return new View("Categorie Modified Successfully", Response::HTTP_OK);
    }

    /**
     * Deletes a categorie entity.
     *
     * @Route("/delete/{id}", name="categorie_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, categorie $categorie)
    {

            $em=$this->getDoctrine()->getManager();
            $p=$em->getRepository('HuntersKingdomBundle:categorie')->find($categorie->getId());
            $em->remove($p);
            $em->flush();
            return new View("categorie Deleted Successfully", Response::HTTP_OK);

    }


}
