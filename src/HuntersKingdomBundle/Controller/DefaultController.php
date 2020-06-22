<?php

namespace HuntersKingdomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HuntersKingdomBundle:Default:index.html.twig');
    }
}
