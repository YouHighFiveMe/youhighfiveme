<?php

namespace Portal\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Portal\AppBundle\Entity\Entry;
use Portal\AppBundle\Form\EntryType;

/**
 * Entry controller.
 */
class EntryController extends Controller
{
    public function createAction()
    {
        $entry = new Entry();

        $request = $this->getRequest();
        $form    = $this->createForm(new EntryType(), $entry);
        
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()
                        ->getEntityManager();
                $em->persist($entry);
                $em->flush();

                return $this->redirect($this->generateUrl('PortalAppBundle_homepage'));
            }
        }

        return $this->render('PortalAppBundle:Post:create.html.twig', array(
            'form' => $form->createView()
        ));
    }
}