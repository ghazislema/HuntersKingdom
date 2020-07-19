<?php

namespace HuntersKingdomBundle\Controller;

use FOS\RestBundle\View\View;
use HuntersKingdomBundle\Entity\Reservation;
use HuntersKingdomBundle\Form\ReservationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Reservation
 * @package HuntersKingdomBundle\Controller
 * @Route("Reservation")
 */
class ReservationController extends Controller
{
    public function indexAction()
    {
        return $this->render('HuntersKingdomBundle:Default:index.html.twig');
    }

    /**
     * Creates a new Reservation entity.
     *
     * @Route("/add", name="reservation_add")
     * @Method({"POST"})
     */
    public function bookAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class , $reservation);
        $form->submit($data);

        $em = $this->getDoctrine()->getManager();
        $em->persist($reservation);
        $em->flush();
    }

}
