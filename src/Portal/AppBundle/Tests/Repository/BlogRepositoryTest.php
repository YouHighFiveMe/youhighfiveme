<?php

namespace Portal\AppBundle\Tests\Repository;

use Portal\AppBundle\Repository\EntryRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EntryRepositoryTest extends WebTestCase
{
    /**
     * @var \Portal\AppBundle\Repository\EntryRepository
     */
    private $entryRepository;

    public function setUp()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $this->entryRepository = $kernel->getContainer()
                                       ->get('doctrine.orm.entity_manager')
                                       ->getRepository('PortalAppBundle:Entry');
    }

    public function testGetTags()
    {
        $tags = $this->entryRepository->getTags();

        $this->assertTrue(count($tags) > 1);
        $this->assertContains('symentry', $tags);
    }

    public function testGetTagWeights()
    {
        $tagsWeight = $this->entryRepository->getTagWeights(
            array('php', 'code', 'code', 'symentry', 'entry')
        );

        $this->assertTrue(count($tagsWeight) > 1);

        // Test case where count is over max weight of 5
        $tagsWeight = $this->entryRepository->getTagWeights(
            array_fill(0, 10, 'php')
        );

        $this->assertTrue(count($tagsWeight) >= 1);

        // Test case with multiple counts over max weight of 5
        $tagsWeight = $this->entryRepository->getTagWeights(
            array_merge(array_fill(0, 10, 'php'), array_fill(0, 2, 'html'), array_fill(0, 6, 'js'))
        );

        $this->assertEquals(5, $tagsWeight['php']);
        $this->assertEquals(3, $tagsWeight['js']);
        $this->assertEquals(1, $tagsWeight['html']);

        // Test empty case
        $tagsWeight = $this->entryRepository->getTagWeights(array());

        $this->assertEmpty($tagsWeight);
    }
}