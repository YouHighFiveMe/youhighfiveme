<?php

namespace Portal\AppBundle\Tests\Entity;

use Portal\AppBundle\Entity\Event;

class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testThatEntityExists()
    {
        $event = new Event();
        $this->assertEquals('Portal\AppBundle\Entity\Event',get_class($event));
    }
    
    public function testSlugify()
    {
        $event = new Event();

        $this->assertEquals('hello-world', $event->slugify('Hello World'));
        $this->assertEquals('a-day-with-symfony2', $event->slugify('A Day With Symfony2'));
        $this->assertEquals('hello-world', $event->slugify('Hello    world'));
        $this->assertEquals('entry', $event->slugify('entry '));
        $this->assertEquals('entry', $event->slugify(' entry'));
    }
    
    public function testSetSlug()
    {
        $event = new Event();

        $event->setSlug('YouHighFiveMe Event');
        $this->assertEquals('youhighfiveme-event', $event->getSlug());
    }

    public function testSetTitle()
    {
        $event = new Event();

        $event->setTitle('Hello World');
        $this->assertEquals('hello-world', $event->getSlug());
    }
}