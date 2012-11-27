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
     * Render a new event form
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction()
    {
        $event = new Event();
        $form = $this->createForm(new EventType(), $event);

        return $this->render('PortalAppBundle:Event:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Create new event
     *
     * This function handles the new event's form data and creates new event
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction()
    {
        $event   = new Event();
        $form    = $this->createForm(new EventType(), $event);
        $user    = $this->getCurrentUser();
        $service = $this->getEventService();

        if (!$this->processForm($form)) {
            return $this->render('PortalAppBundle:Event:create.html.twig', array(
                'form' => $form->createView()
            ));
        }

        $service->saveEvent($event, $user);
        return $this->redirect($this->generateUrl('PortalAppBundle_homepage'));
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

        $eventService    = $this->getEventService();
        $highfiveService = $this->getHighfiveService();

        $request  = $this->getRequest();
        $form     = $this->createForm(new HighfiveType(), $highfive);
        $user     = $this->getCurrentUser();
        $event    = $eventService->getEventById($eventId);

        $submitted = false;
        $showForm  = true;

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