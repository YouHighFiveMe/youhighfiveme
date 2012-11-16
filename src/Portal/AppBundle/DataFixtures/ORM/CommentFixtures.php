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
        $comment = new Comment();
        $comment->setUser('symfony');
        $comment->setComment('To make a long story short. You can\'t go wrong by choosing Symfony! And no one has ever been fired for using Symfony.');
        $comment->setEntry($manager->merge($this->getReference('entry-1')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('David');
        $comment->setComment('To make a long story short. Choosing a framework must not be taken lightly; it is a long-term commitment. Make sure that you make the right selection!');
        $comment->setEntry($manager->merge($this->getReference('entry-1')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Dade');
        $comment->setComment('Anything else, mom? You want me to mow the lawn? Oops! I forgot, New York, No grass.');
        $comment->setEntry($manager->merge($this->getReference('entry-2')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Kate');
        $comment->setComment('Are you challenging me? ');
        $comment->setEntry($manager->merge($this->getReference('entry-2')));
        $comment->setCreated(new \DateTime("2011-07-23 06:15:20"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Dade');
        $comment->setComment('Name your stakes.');
        $comment->setEntry($manager->merge($this->getReference('entry-2')));
        $comment->setCreated(new \DateTime("2011-07-23 06:18:35"));
        $manager->persist($comment);
        
        $comment = new Comment();
        $comment->setUser('Kate');
        $comment->setComment('If I win, you become my slave.');
        $comment->setEntry($manager->merge($this->getReference('entry-2')));
        $comment->setCreated(new \DateTime("2011-07-23 06:22:53"));
        $manager->persist($comment);
        
        $comment = new Comment();
        $comment->setUser('Dade');
        $comment->setComment('Your SLAVE?');
        $comment->setEntry($manager->merge($this->getReference('entry-2')));
        $comment->setCreated(new \DateTime("2011-07-23 06:25:15"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Kate');
        $comment->setComment('You wish! You\'ll do shitwork, scan, crack copyrights...');
        $comment->setEntry($manager->merge($this->getReference('entry-2')));
        $comment->setCreated(new \DateTime("2011-07-23 06:46:08"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Dade');
        $comment->setComment('And if I win?');
        $comment->setEntry($manager->merge($this->getReference('entry-2')));
        $comment->setCreated(new \DateTime("2011-07-23 10:22:46"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Kate');
        $comment->setComment('Make it my first-born!');
        $comment->setEntry($manager->merge($this->getReference('entry-2')));
        $comment->setCreated(new \DateTime("2011-07-23 11:08:08"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Dade');
        $comment->setComment('Make it our first-date!');
        $comment->setEntry($manager->merge($this->getReference('entry-2')));
        $comment->setCreated(new \DateTime("2011-07-24 18:56:01"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Kate');
        $comment->setComment('I don\'t DO dates. But I don\'t lose either, so you\'re on!');
        $comment->setEntry($manager->merge($this->getReference('entry-2')));
        $comment->setCreated(new \DateTime("2011-07-25 22:28:42"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Stanley');
        $comment->setComment('It\'s not gonna end like this.');
        $comment->setEntry($manager->merge($this->getReference('entry-3')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Gabriel');
        $comment->setComment('Oh, come on, Stan. Not everything ends the way you think it should. Besides, audiences love happy endings.');
        $comment->setEntry($manager->merge($this->getReference('entry-3')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Mile');
        $comment->setComment('Doesn\'t Bill Gates have something like that?');
        $comment->setEntry($manager->merge($this->getReference('entry-2')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Gary');
        $comment->setComment('Bill Who?');
        $comment->setEntry($manager->merge($this->getReference('entry-1')));
        $manager->persist($comment);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
