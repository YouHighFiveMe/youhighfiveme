<?php

namespace Portal\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Portal\AppBundle\Entity\Comment;
use Portal\AppBundle\Entity\Entry;

class CommentFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(\Doctrine\Common\Persistence\ObjectManager $manager)
    {
        /*
        $comment = new Comment();
        $comment->setUser('symfony');
        $comment->setComment('To make a long story short. You can\'t go wrong by choosing Symfony! And no one has ever been fired for using Symfony.');
        $comment->setEntry($manager->merge($this->getReference('entry-1')));
        $manager->persist($comment);

        $manager->flush();
        */
    }

    public function getOrder()
    {
        return 2;
    }
}
