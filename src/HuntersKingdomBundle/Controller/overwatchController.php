<?php

namespace HuntersKingdomBundle\Controller;

use FOS\RestBundle\View\View;
use HuntersKingdomBundle\Entity\overwatch;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class overwatchController extends Controller
{
    /**
     * Lists all overwatch entities.
     *
     * @Route("/api/overwatch", name="overwatch_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $threads = $em->getRepository('HuntersKingdomBundle:overwatch')->findAll();
        $data=$this->get('jms_serializer')->serialize($threads,'json');
        $response = new Response($data);
        return $response;
    }

    /**
     * Creates a new overwatch entity.
     *
     * @Route("/api/overwatchreport/new", name="overwatch_new_rep")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $data = $request->getContent();
        $overwatch = $this->get('jms_serializer') ->deserialize($data, 'HuntersKingdomBundle\Entity\overwatch', 'json');
        $em = $this->getDoctrine()->getManager();
        $oldoverwatch=$em->getRepository('HuntersKingdomBundle:overwatch')
            ->findBy(['subjectId' => $overwatch->getSubjectId(),'type'=>$overwatch->getType(),'reason'=> $overwatch->getReason()]);
        if ($oldoverwatch != null) {
            $nbvote = $oldoverwatch[0]->getReportNb();
            $nbvote = (int) $nbvote + 1;
            $oldoverwatch[0]->setReportNb($nbvote);
            $em->persist($oldoverwatch[0]);
        }
        else {
            $em->persist($overwatch);
        }
        $em->flush();
        return new View("Subject to overwatch Added Successfully", Response::HTTP_OK);
    }

    /**
     * Creates a new rep entity.
     *
     * @Route("/api/userreport/new", name="user_new_rep")
     * @Method({"GET", "POST"})
     */
    public function newUserReport(Request $request)
    {
        $data = $request->getContent();
        $rep = $this->get('jms_serializer') ->deserialize($data, 'HuntersKingdomBundle\Entity\report', 'json');
        $em = $this->getDoctrine()->getManager();
        $em->persist($rep);
        $em->flush();
        return new View("Report Added Successfully", Response::HTTP_OK);
    }

    /**
     * Finds and displays a overwatch entity.
     *
     * @Route("/{id}", name="overwatch_show")
     * @Method("GET")
     */
    public function showAction(overwatch $overwatch)
    {
        $data=$this->get('jms_serializer')->serialize($overwatch,'json');
        $response=new Response($data);
        return $response;
    }

    /**
     * Displays a form to edit an existing overwatch entity.
     *
     * @Route("/{id}/edit", name="overwatch_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, overwatch $overwatch)
    {
        $deleteForm = $this->createDeleteForm($overwatch);
        $editForm = $this->createForm('HuntersKingdomBundle\Form\overwatchType', $overwatch);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('overwatch_edit', array('id' => $overwatch->getId()));
        }

        return $this->render('overwatch/edit.html.twig', array(
            'overwatch' => $overwatch,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a overwatch entity.
     *
     * @Route("/api/overwatch/{id}/delete", name="overwatch_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, overwatch $overwatch)
    {
        $em=$this->getDoctrine()->getManager();

        if ($overwatch->getType() == "Thread")
        {
            $p=$em->getRepository('HuntersKingdomBundle:thread')->find($overwatch->getSubjectId());
            $em->remove($p);
        }
        else {
            $p=$em->getRepository('HuntersKingdomBundle:threaddetail')->find($overwatch->getSubjectId());
            $em->remove($p);
        }

        $ow=$em->getRepository('HuntersKingdomBundle:overwatch')->find($overwatch->getId());
        $em->remove($ow);
        $em->flush();
        return new View("Subject has been deleted", Response::HTTP_OK);
    }


    /**
     * Deletes an overwatch entity.
     *
     * @Route("/api/overwatch/{id}/ignore", name="overwatch_ignore")
     * @Method({"DELETE"})
     */
    public function ignoreSubject(Request $request, overwatch $overwatch)
    {
        $em=$this->getDoctrine()->getManager();
        $p=$em->getRepository('HuntersKingdomBundle:overwatch')->find($overwatch->getId());
        $em->remove($p);
        $em->flush();
        return new View("Report has been ignored", Response::HTTP_OK);
    }

    /**
     * get an report entity.
     *
     * @Route("/api/checkreport/{subjid}/{userid}/{subjtype}", name="check_rep")
     * @Method({"GET"})
     */
    public function checkreport(Request $request)
    {
        $subjid = $request->get('subjid');
        $userid = $request->get('userid');
        $subjtype = $request->get('subjtype');
        $em=$this->getDoctrine()->getManager();
        $p=$em->getRepository('HuntersKingdomBundle:report')->findBy(['subject' => $subjtype,'user' => $userid, 'subjectid' => $subjid ]);
        $data=$this->get('jms_serializer')->serialize($p,'json');
        $response = new Response($data);
        return $response;
    }

    /**
     * Lists all report entities.
     *
     * @Route("/api/reports", name="reports_ind")
     * @Method("GET")
     */
    public function findAllReports()
    {
        $em = $this->getDoctrine()->getManager();
        $threads = $em->getRepository('HuntersKingdomBundle:report')->findAll();$data=$this->get('jms_serializer')->serialize($threads,'json');
        $response = new Response($data);
        return $response;
    }
}
