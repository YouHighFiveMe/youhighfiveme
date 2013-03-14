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
class HighFiveController extends BaseController
{
    /**
     * Show all High Fives
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAllAction($orderType = 'asc')
    {
        $order = 'asc';
        if ($orderType == 'desc') {
            $order = 'desc';
        }

        $limit = null;

        $highFiveService = $this->getHighfiveService();
        $highFives = $highFiveService->getAllHighfivesforPublicEvents($limit, $orderType);

        return $this->render('PortalAppBundle:Page:allHighFives.html.twig', array(
            'highfives' => $highFives,
        ));
    }

}