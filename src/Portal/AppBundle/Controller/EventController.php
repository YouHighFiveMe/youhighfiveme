<?php

namespace Portal\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Portal\AppBundle\Entity\Event;
use Portal\AppBundle\Form\EventType;
use Portal\AppBundle\Entity\Highfive;
use Portal\AppBundle\Form\HighfiveType;

/**
 * Event controller.
 */
class EventController extends Controller
{
    /**
     * Create new event
     *
     * This function handles the new event's form data and creates new event
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction()
    {
        $event = new Event();

        $request = $this->getRequest();
        $form    = $this->createForm(new EventType(), $event);
        
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()
                        ->getManager();
                
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

    /**
     * View Event
     *
     * @param $eventId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($eventId)
    {
        $highfive = new Highfive();

        $request  = $this->getRequest();
        $eventService  = $this->getEventService();
        $highfiveService  = $this->getHighfiveService();
        $event    = $eventService->getEventById($eventId);
        $user     = $this->container->get('security.context')->getToken()->getUser();
        $form     = $this->createForm(new HighfiveType(), $highfive);
        $showForm = true;

        if ($highfiveService->hasUserSubmittedHighfiveForEvent($event, $user)) {
            $showForm = false;
        }

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()
                    ->getManager();

                $highfive->setUser($user);
                $highfive->setEvent($event);

                $em->persist($highfive);
                $em->flush();
                $showForm = false;
            }
        }

        return $this->render('PortalAppBundle:Event:view.html.twig', array(
            'event'    => $event,
            'form'     => $form->createView(),
            'showForm' => $showForm
        ));
    }

    /**
     * @return EventService
     */
    protected function getEventService()
    {
        return $this->container->get('portal_app.service.event');
    }

    /**
     * @return HighfiveService
     */
    protected function getHighfiveService()
    {
        return $this->container->get('portal_app.service.highfive');
    }

}