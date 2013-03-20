<?php

namespace Portal\AppBundle\Controller;

use Portal\AppBundle\Controller\BaseController;

/**
 * User controller.
 */
class UserController extends BaseController
{
    /**
     * Show all users and their stats
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAllAction()
    {
        $service = $this->getUserService();
        $users = $service->getUsers();

        return $this->render('PortalAppBundle:User:allUsers.html.twig', array(
            'users' => $users,
        ));
    }

}