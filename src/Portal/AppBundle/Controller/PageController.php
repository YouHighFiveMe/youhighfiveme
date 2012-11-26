<?php

namespace Portal\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Portal\AppBundle\Entity\Enquiry;
use Portal\AppBundle\Form\EnquiryType;

class PageController extends Controller
{
    public function indexAction()
    {
        $service = $this->getEventService();
        $events = $service->getLatestPublicEvents(5);

        return $this->render('PortalAppBundle:Page:index.html.twig', array(
            'events' => $events
        ));
    }
    
    public function aboutAction()
    {
        return $this->render('PortalAppBundle:Page:about.html.twig');
    }
    
    public function contactAction()
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);
    
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
    
            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject('Contact enquiry from the app')
                    ->setFrom('info@arturgajewski.com')
                    ->setTo($this->container->getParameter('portal_app.emails.contact_email'))
                    ->setBody($this->renderView('PortalAppBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
                $this->get('mailer')->send($message);
        
                $this->get('session')->setFlash('app-notice', 'Your contact enquiry was successfully sent. Thank you!');
        
                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('PortalAppBundle_contact'));
            }
        }
    
        return $this->render('PortalAppBundle:Page:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function sidebarAction()
    {
        $em = $this->getDoctrine()
                   ->getEntityManager();
    
        $tags = $em->getRepository('PortalAppBundle:Entry')
                   ->getTags();
    
        $tagWeights = $em->getRepository('PortalAppBundle:Entry')
                         ->getTagWeights($tags);
    
        $commentLimit   = $this->container
                               ->getParameter('portal_app.comments.latest_comment_limit');
        $latestComments = $em->getRepository('PortalAppBundle:Comment')
                             ->getLatestComments($commentLimit);
    
        return $this->render('PortalAppBundle:Page:sidebar.html.twig', array(
            'latestComments'    => $latestComments,
            'tags'              => $tagWeights
        ));
    }

    /**
     * @return EventService
     */
    protected function getEventService()
    {
        return $this->container->get('portal_app.service.event');
    }

}
