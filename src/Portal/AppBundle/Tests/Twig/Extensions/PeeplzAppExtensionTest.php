<?php

namespace Portal\AppBundle\Tests\Twig\Extensions;

use Portal\AppBundle\Twig\Extensions\PortalAppExtension;

class PortalAppExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testCreatedAgo()
    {
        $entry = new PortalAppExtension();

        $this->assertEquals("0 seconds ago", $entry->createdAgo(new \DateTime()));
        $this->assertEquals("34 seconds ago", $entry->createdAgo($this->getDateTime(-34)));
        $this->assertEquals("1 minute ago", $entry->createdAgo($this->getDateTime(-60)));
        $this->assertEquals("2 minutes ago", $entry->createdAgo($this->getDateTime(-120)));
        $this->assertEquals("1 hour ago", $entry->createdAgo($this->getDateTime(-3600)));
        $this->assertEquals("1 hour ago", $entry->createdAgo($this->getDateTime(-3601)));
        $this->assertEquals("2 hours ago", $entry->createdAgo($this->getDateTime(-7200)));

        // Cannot create time in the future
        $this->setExpectedException('\Exception');
        $entry->createdAgo($this->getDateTime(60));
    }

    protected function getDateTime($delta)
    {
        return new \DateTime(date("Y-m-d H:i:s", time()+$delta));
    }
}