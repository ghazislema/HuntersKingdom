<?php

namespace HuntersKingdomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class produitController extends Controller
{


    /**
     * @Route("/product/add")
     * @Method("POST")
     */
    public function addAction(Request $request)
    {
        //récupérer le contenu de la requête envoyé par l'outil postman
        $data = $request->getContent();
        //deserialize data: création d'un objet 'produit' à partir des données json envoyées
        $produit = $this->get('jms_serializer') ->deserialize($data, 'HunterKingdomBundle\Entity\produit', 'json');
        //ajout dans la base
        $em = $this->getDoctrine()->getManager();
        $em->persist($produit);
        $em->flush();
        return new Response('produit ajouté avec succès');
    }


}
