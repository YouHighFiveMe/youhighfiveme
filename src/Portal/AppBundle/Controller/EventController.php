<?php

namespace Portal\AppBundle\Controller;

use Portal\AppBundle\Controller\BaseController;
use Portal\AppBundle\Entity\Event;
use Portal\AppBundle\Form\EventType;
use Portal\AppBundle\Entity\Highfive;
use Portal\AppBundle\Form\HighfiveType;

/**
 * Event controller.
 */
class EventController extends BaseController
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
        $request = $this->getRequest();
        $event = new Event();
        $form = $this->createForm(new EventType(), $event);
        $user = $this->getCurrentUser();
        
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()
                        ->getManager();
                
                $event->setUser($user);
                $em->persist($event);
                $em->flush();

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
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
        $request  = $this->getRequest();
        $highfive = new Highfive();
        $eventService = $this->getEventService();
        $highfiveService = $this->getHighfiveService();
        $event = $eventService->getEventById($eventId);
        $user = $this->getCurrentUser();
        $form = $this->createForm(new HighfiveType(), $highfive);
        $submitted = false;
        $showForm = true;

        if ($user) {
            if ($highfiveService->hasUserSubmittedHighfiveForEvent($event, $user)) {
                $submitted = true;
                $showForm = false;
            }
        } else {
            $showForm = false;
        }

        if ($request->getMethod() == 'POST' && !$submitted) {
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

}