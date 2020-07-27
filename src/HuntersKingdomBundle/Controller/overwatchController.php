<?php

namespace HuntersKingdomBundle\Controller;

use FOS\RestBundle\View\View;
use HuntersKingdomBundle\Entity\overwatch;
use HuntersKingdomBundle\Entity\vote;
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

    /**
     * get an report entity.
     *
     * @Route("/api/checkvote/{subjid}/{userid}", name="checkvote_api")
     * @Method({"GET"})
     */
    public function checkVote(Request $request)
    {
        $subjid = $request->get('subjid');
        $userid = $request->get('userid');
        $em=$this->getDoctrine()->getManager();
        $p=$em->getRepository('HuntersKingdomBundle:vote')->findBy(['threadid' => $subjid,'userid' => $userid ]);
        $data=$this->get('jms_serializer')->serialize($p,'json');
        $response = new Response($data);
        return $response;
    }

    /**
     * add vote ent
     *
     * @Route("/api/addvote/new", name="newvote_inx")
     * @Method({"POST"})
     */
    public function addVote(Request $request)
    {
        $data = $request->getContent();
        $vote = $this->get('jms_serializer') ->deserialize($data, 'HuntersKingdomBundle\Entity\vote', 'json');
        $em = $this->getDoctrine()->getManager();
        $em->persist($vote);
        $em->flush();
        return new View("Vote Added Successfully", Response::HTTP_OK);
    }

    /**
     * add vote ent
     *
     * @Route("/api/updatevote/{subjid}/{userid}/{votel}", name="updatevote_newx")
     * @Method({"POST"})
     */
    public function updateVote(Request $request)
    {
        $subjid = $request->get('subjid');
        $userid = $request->get('userid');
        $em=$this->getDoctrine()->getManager();
        $vote=$em->getRepository('HuntersKingdomBundle:vote')->findBy(['threadid' => $subjid,'userid' => $userid ]);
        $vote[0]->setVote($request->get('votel'));
        $em->persist($vote[0]);
        $em->flush();
        return new View("Vote updated Successfully", Response::HTTP_OK);;
    }

    /**
     * Lists all votes entities.
     *
     * @Route("/api/votes/all", name="voteadd")
     * @Method("GET")
     */
    public function findAllVotes()
    {
        $em = $this->getDoctrine()->getManager();
        $threads = $em->getRepository('HuntersKingdomBundle:vote')->findAll();
        $data=$this->get('jms_serializer')->serialize($threads,'json');
        $response = new Response($data);
        return $response;
    }
}
