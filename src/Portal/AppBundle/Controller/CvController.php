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
        $request  = $this->getRequest();
        $user     = $this->getCurrentUser();



        return $this->render('PortalAppBundle:Cv:view.html.twig', array(
        ));
    }

}