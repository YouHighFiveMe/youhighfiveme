<?php

namespace Portal\AppBundle\Service;

use Doctrine\ORM\EntityManager,
    Doctrine\ORM\EntityRepository,
    Symfony\Component\Security\Core\SecurityContext;

class EventService
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EventRepository
     */
    protected $repository;

    /**
     * @var SecurityContext
     */
    protected $security;

    /**
     * @param EntityManager    $em
     * @param EntityRepository $repository
     * @param SecurityContext  $security
     */
    public function __construct(EntityManager $em, EntityRepository $repository, SecurityContext $security)
    {
        $this->em               = $em;
        $this->repository       = $repository;
        $this->security         = $security;
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return $this->repository->findAll();
    }

    /**
     * @return array
     */
    public function getLatestPublicEvents($limit = null)
    {
        return $this->repository->getLatestPublicEvents($limit);
    }

    /**
     * @param  int $id
     * @return Event
     */
    public function getEventById($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @return array
     */
    public function getEventsForCurrentUser()
    {
        return $this->repository->findAllForUser($this->security->getToken()->getUser());
    }

    /**
     * @return boolean
     */
    public function isCurrentUserCreatorOfEvent(Event $event)
    {
        return $event->getUser() == $this->security->getToken()->getUser();
    }

    /**
     * @param  Event $event
     * @param  User  $user
     * @return Event
     */
    public function saveEvent(Event $event, User $user = null)
    {
        if (!$user) {
            $user = $this->security->getToken()->getUser();
        }
        $event->setUser($user);
        $this->em->persist($event);
        $this->em->flush();

        return $event;
    }

}
