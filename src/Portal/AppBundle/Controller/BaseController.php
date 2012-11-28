<?php

namespace Portal\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;

/**
 * Base controller.
 *
 * Place all common functions here available across all controllers
 */
class BaseController extends Controller
{
    /**
     * @param Form $form
     * @return boolean
     */
    public function processForm(Form $form)
    {
        $form->bind($this->getRequest());
        return $form->isValid();
     }

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
    public function getEventService()
    {
        return $this->container->get('portal_app.service.event');
    }

    /**
     * @return HighfiveService
     */
    public function getHighfiveService()
    {
        return $this->container->get('portal_app.service.highfive');
    }

}