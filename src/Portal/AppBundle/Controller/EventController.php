<?php

namespace Portal\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Portal\AppBundle\Entity\Event;
use Portal\AppBundle\Form\EventType;

/**
 * Event controller.
 */
class EventController extends Controller
{
    public function createAction()
    {
        $event = new Event();

        $request = $this->getRequest();
        $form    = $this->createForm(new EventType(), $event);
        
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()
                        ->getEntityManager();
                
                $event->setUser($user);
                
                $em->persist($event);
                $em->flush();
                
                return $this->redirect($this->generateUrl('PortalAppBundle_homepage'));
            }
        }

        return $this->render('PortalAppBundle:Event:create.html.twig', array(
            'form' => $form->createView()
        ));
    }
}