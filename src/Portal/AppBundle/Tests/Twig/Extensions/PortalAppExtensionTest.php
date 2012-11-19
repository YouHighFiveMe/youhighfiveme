<?php

namespace Portal\AppBundle\Tests\Twig\Extensions;

use Portal\AppBundle\Twig\Extensions\PortalAppExtension;

class PortalAppExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testCreatedAgo()
    {
        $extension = new PortalAppExtension();

        $this->assertEquals("0 seconds ago", $extension->createdAgo(new \DateTime()));
        $this->assertEquals("34 seconds ago", $extension->createdAgo($this->getDateTime(-34)));
        $this->assertEquals("1 minute ago", $extension->createdAgo($this->getDateTime(-60)));
        $this->assertEquals("2 minutes ago", $extension->createdAgo($this->getDateTime(-120)));
        $this->assertEquals("1 hour ago", $extension->createdAgo($this->getDateTime(-3600)));
        $this->assertEquals("1 hour ago", $extension->createdAgo($this->getDateTime(-3601)));
        $this->assertEquals("2 hours ago", $extension->createdAgo($this->getDateTime(-7200)));
    }

    protected function getDateTime($delta)
    {
        return new \DateTime(date("Y-m-d H:i:s", time()+$delta));
    }
    
    public function testShowMaxLen()
    {
        $extension = new PortalAppExtension();

        $this->assertEquals("abc", $extension->showMaxLen('abcdefg', 3));
        $this->assertEquals("abcdefg", $extension->showMaxLen('abcdefg', 7));
        $this->assertEquals("abcdefg", $extension->showMaxLen('abcdefg', 10));
    }
}