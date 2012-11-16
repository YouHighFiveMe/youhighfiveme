<?php

namespace Portal\AppBundle\Tests\Entity;

use Portal\AppBundle\Entity\Entry;

class EntryTest extends \PHPUnit_Framework_TestCase
{
    public function testSlugify()
    {
        $entry = new Entry();

        $this->assertEquals('hello-world', $entry->slugify('Hello World'));
        $this->assertEquals('a-day-with-symfony2', $entry->slugify('A Day With Symfony2'));
        $this->assertEquals('hello-world', $entry->slugify('Hello    world'));
        $this->assertEquals('entry', $entry->slugify('entry '));
        $this->assertEquals('entry', $entry->slugify(' entry'));
    }
    
    public function testSetSlug()
    {
        $entry = new Entry();

        $entry->setSlug('Symfony2 Entry');
        $this->assertEquals('symfony2-entry', $entry->getSlug());
    }

    public function testSetTitle()
    {
        $entry = new Entry();

        $entry->setTitle('Hello World');
        $this->assertEquals('hello-world', $entry->getSlug());
    }
}