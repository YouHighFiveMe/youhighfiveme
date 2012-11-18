<?php

namespace Portal\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Portal\AppBundle\Entity\Highfive;
use Portal\AppBundle\Entity\Event;

class HighfiveFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(\Doctrine\Common\Persistence\ObjectManager $manager)
    {
        $highfive1 = new Highfive();
        $highfive1->setUser('Symfony1');
        $highfive1->setComment('Great job! ^5 for you brotha!');
        $highfive1->setEvent($manager->merge($this->getReference('event-1')));
        $manager->persist($highfive1);

        $highfive2 = new Highfive();
        $highfive2->setUser('Symfony2');
        $highfive2->setComment('^5 from Finland!');
        $highfive2->setEvent($manager->merge($this->getReference('event-2')));
        $manager->persist($highfive2);
        
        $highfive3 = new Highfive();
        $highfive3->setUser('Symfony3');
        $highfive3->setComment('Thx for a great tutorial!');
        $highfive3->setEvent($manager->merge($this->getReference('event-2')));
        $manager->persist($highfive3);
        
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
