<?php

namespace Portal\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Portal\AppBundle\Entity\Entry;

class EntryFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(\Doctrine\Common\Persistence\ObjectManager $manager)
    {
        /*
        $entry1 = new Entry();
        $entry1->setTitle('Lorem ipsum dolor sit amet');
        $entry1->setEntry('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.');
        $entry1->setAuthor('Artur Gajewski');
        $entry1->setImage('http://www.gravatar.com/avatar/996dd2c71c40e59cbfc99e67f9a4c5f8?s=80&r=g&d=mm');
        $entry1->setTags('symfony2, php, paradise, symentry');
        $entry1->setCreated(new \DateTime());
        $entry1->setUpdated($entry1->getCreated());
        $manager->persist($entry1);

        $manager->flush();
        
        $this->addReference('entry-1', $entry1);
        */
    }
    
    public function getOrder()
    {
        return 1;
    }
}
