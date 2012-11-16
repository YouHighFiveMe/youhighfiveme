<?php

namespace Portal\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Portal\AppBundle\Entity\Comment;
use Portal\AppBundle\Form\CommentType;

/**
 * Comment controller.
 */
class CommentController extends Controller
{
    public function newAction($entry_id)
    {
        $entry = $this->getEntry($entry_id);

        $comment = new Comment();
        $comment->setEntry($entry);
        $form   = $this->createForm(new CommentType(), $comment);

        return $this->render('PortalAppBundle:Comment:form.html.twig', array(
            'comment' => $comment,
            'form'   => $form->createView()
        ));
    }

    public function createAction($entry_id)
    {
        $entry = $this->getEntry($entry_id);

        $comment  = new Comment();
        $comment->setEntry($entry);
        $request = $this->getRequest();
        $form    = $this->createForm(new CommentType(), $comment);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($comment);
            $em->flush();
                
            return $this->redirect($this->generateUrl('PortalAppBundle_entry_show', array(
                'id'    => $comment->getEntry()->getId(),
                'slug'  => $comment->getEntry()->getSlug())) .
                '#comment-' . $comment->getId()
            );
        }

        return $this->render('PortalAppBundle:Comment:create.html.twig', array(
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }

    protected function getEntry($entry_id)
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $entry = $em->getRepository('PortalAppBundle:Entry')->find($entry_id);

        if (!$entry) {
            throw $this->createNotFoundException('Unable to find Entry post.');
        }

        return $entry;
    }

}
