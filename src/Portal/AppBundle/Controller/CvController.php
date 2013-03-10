<?php

namespace Portal\AppBundle\Controller;

use Portal\AppBundle\Controller\BaseController;
use Portal\AppBundle\Entity\Event;
use Portal\AppBundle\Form\EventType;
use Portal\AppBundle\Entity\Highfive;
use Portal\AppBundle\Form\HighfiveType;

/**
 * Curriculum Vitae controller.
 */
class CvController extends BaseController
{
    /**
     * View CV
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction()
    {
        $user     = $this->getCurrentUser();
        $service  = $this->getEventService();
        $events   = array();

        if ($user) {
            $events = $service->getEventsForCurrentUser();
        }

        return $this->render('PortalAppBundle:Cv:view.html.twig', array(
            'user'   => $user,
            'events' => $events,
        ));
    }

    /**
     * View CV for a gicen user
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function userAction($username)
    {
        $service     = $this->getEventService();
        $userManager = $this->get('fos_user.user_manager');
        $events      = array();

        $user        = $userManager->findUserBy(array('username' => $username));

        if ($user) {
            $events = $service->getEventsForUser($user);
        }

        return $this->render('PortalAppBundle:Cv:view.html.twig', array(
            'user'   => $user,
            'events' => $events,
        ));
    }

}