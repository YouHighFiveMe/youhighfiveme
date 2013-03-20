<?php

namespace Portal\AppBundle\Service;

use Doctrine\ORM\EntityManager,
    Doctrine\ORM\EntityRepository,
    Symfony\Component\Security\Core\SecurityContext,
    Portal\AppBundle\Entity\Event,
    Portal\AppBundle\Entity\Highfive,
    Portal\AppBundle\Entity\QuickHighfive,
    Portal\UserBundle\Entity\User;


class UserService
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var UserRepository
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
    public function getUsers()
    {
        return $this->repository->findAll();
    }

}
