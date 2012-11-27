<?php

namespace Portal\AppBundle\Service;

use Doctrine\ORM\EntityManager,
    Doctrine\ORM\EntityRepository,
    Symfony\Component\Security\Core\SecurityContext,
    Portal\AppBundle\Entity\Event,
    Portal\AppBundle\Entity\Highfive,
    Portal\UserBundle\Entity\User;


class HighfiveService
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var HighfiveRepository
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
    public function getHighfives()
    {
        return $this->repository->findAll();
    }

    /**
     * @return array
     */
    public function getLatestHighfivesForPublicEvents($limit = null)
    {
        return $this->repository->getLatestHighfivesForPublicEvents($limit);
    }

    /**
     * @param  int $id
     * @return Event
     */
    public function getHighfiveById($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Check to see if a user already has given a high five for an event
     *
     * @param \Portal\AppBundle\Entity\Event $event
     * @param \Portal\UserBundle\Entity\User $user
     * @return bool
     */
    public function hasUserSubmittedHighfiveForEvent(Event $event, User $user)
    {
        $result = $this->repository->findBy(
            array(
                'user'  => $user,
                'event' => $event
            )
        );

        return sizeOf($result) > 0 ? true : false;
    }

    /**
     * @param  Highfive $highfive
     * @param  Event $event
     * @param  User  $user
     * @return Event
     */
    public function saveHighfive(Highfive $highfive, Event $event, User $user = null)
    {
        if (!$user) {
            $user = $this->security->getToken()->getUser();
        }

        $highfive->setUser($user);
        $highfive->setEvent($event);

        $this->em->persist($highfive);
        $this->em->flush();

        return $highfive;
    }

}
