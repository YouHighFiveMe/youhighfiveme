<?php

namespace Portal\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Portal\AppBundle\Entity\Event;

class EventFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(\Doctrine\Common\Persistence\ObjectManager $manager)
    {
        $event1 = new Event();
        $event1->setTitle('Lorem ipsum dolor sit amet');
        $event1->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.');
        $event1->setTags('symfony2, php, paradise, high five');
        $event1->setCreated(new \DateTime());
        $event1->setUpdated($event1->getCreated());
        $manager->persist($event1);

        $event2 = new Event();
        $event2->setTitle('Ipsum Lorem sit dolor amet');
        $event2->setDescription('Lorem consectetur adipiscing eletra ipsum dolor sit amet.');
        $event2->setTags('symfony2, php, paradise, high five');
        $event2->setCreated(new \DateTime());
        $event2->setUpdated($event2->getCreated());
        $manager->persist($event2);

        $event3 = new Event();
        $event3->setTitle('Yet another Lorem Ipsum');
        $event3->setDescription('Lorem blaa blaa blaa consectetur blaa blaa adipiscing eletra ipsum dolor sit amet.');
        $event3->setTags('symfony2, php, paradise, high five');
        $event3->setCreated(new \DateTime());
        $event3->setUpdated($event3->getCreated());
        $manager->persist($event3);
        
        $manager->flush();
        
        $this->addReference('event-1', $event1);
        $this->addReference('event-2', $event2);
        $this->addReference('event-3', $event3);
    }
    
    public function getOrder()
    {
        return 1;
    }
}
