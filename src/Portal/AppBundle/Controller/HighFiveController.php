<?php

namespace Portal\AppBundle\Controller;

use Portal\AppBundle\Controller\BaseController;
use Portal\AppBundle\Entity\QuickHighfive;
use Portal\AppBundle\Form\QuickHighfiveType;

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

    /**
     * Show all Quick High Fives for current user
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAllQuickHighFivesAction($orderType = 'asc')
    {
        $highFiveService = $this->getHighfiveService();
        $eventService    = $this->getEventService();
        $latestEvents    = $eventService->getLatestPublicEvents($this->container->getParameter('portal_app.comments.max_latest_events'));

        $user = $this->getCurrentUser();
        $limit = null;

        if (!$user) {
            return $this->render('PortalAppBundle:Event:noaccess.html.twig', array('latestEvents' => $latestEvents));
        }

        $order = 'asc';
        if ($orderType == 'desc') {
            $order = 'desc';
        }

        $quickHighFives = $highFiveService->getAllQuickHighfivesForUser($user, $limit, $order);

        return $this->render('PortalAppBundle:Page:allQuickHighFives.html.twig', array(
            'quickHighfives' => $quickHighFives,
            'latestEvents'   => $latestEvents,
        ));
    }

    /**
     * Send a quick high five to a specific user
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function quickAction($username)
    {
        $currentUser     = $this->getCurrentUser();
        $eventService    = $this->getEventService();
        $highfiveService = $this->getHighfiveService();

        $latestEvents    = $eventService->getLatestPublicEvents($this->container->getParameter('portal_app.comments.max_latest_events'));

        $enableCaptcha = true;
        if ($currentUser) {
            $enableCaptcha = false;
        } else {
            if (!$this->container->getParameter('portal_app.enable_recaptha')) {
                $enableCaptcha = false;
            }
        }

        $quickHighfive   = new QuickHighfive($enableCaptcha);
        $request         = $this->getRequest();
        $form            = $this->createForm(new QuickHighfiveType(), $quickHighfive);

        if ($enableCaptcha === false) {
            $form->remove('recaptcha');
            $form->remove('author');
        }

        $userManager     = $this->container->get('fos_user.user_manager');
        $user            = $userManager->findUserByUsername($username);

        if (!$user) {
            return $this->render('PortalAppBundle:Event:userNotFound.html.twig', array());
        }

        $showForm = true;

        if ($request->getMethod() == 'POST') {
            if ($this->processForm($form)) {
                $quickHighfive->setUser($user);

                if ($currentUser) {
                    $quickHighfive->setAuthor($currentUser->getName());
                }

                $highfiveService->saveQuickHighfive($quickHighfive);

                $this->sendMail("You have received new quick high five",
                    $user->getEmail(),
                    $this->renderView('PortalAppBundle:Page:newQuickHighFiveEmail.txt.twig',
                        array(
                            'to'   => $user,
                            'from' => $quickHighfive->getAuthor(),
                        )
                    ));

                $this->get('session')->getFlashBag()->add('highfive.saved', 'Your quick high hive has been sent, thank you!');
                $showForm = false;
            }
        }

        return $this->render('PortalAppBundle:HighFive:quick.html.twig', array(
            'form' => $form->createView(),
            'user' => $user,
            'latestEvents' => $latestEvents,
            'showForm' => $showForm,
        ));
    }

}