<?php

namespace Portal\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Base controller.
 *
 * Place all common functions here available across all controllers
 */
class BaseController extends Controller
{
    /**
     * Return current user's entity or null if not logged in
     *
     * @return null|App/UserBundle/Entity/User
     */
    public function getCurrentUser() {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if ($user === 'anon.') {
            return null;
        }
        return $user;
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