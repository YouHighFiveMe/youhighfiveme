<?php

namespace Portal\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase
{
    public function testAbout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/about');

        $this->assertEquals(1, $crawler->filter('h1:contains("About app")')->count());
    }
    
    public function testIndex()
    {
        $client = static::createClient();
    
        $crawler = $client->request('GET', '/');
    
        // Check there are some entry entries on the page
        $this->assertTrue($crawler->filter('article.entry')->count() > 0);
        
        // Find the first link, get the title, ensure this is loaded on the next page
        $entryLink   = $crawler->filter('article.entry h2 a')->first();
        $entryTitle  = $entryLink->text();
        $crawler    = $client->click($entryLink->link());

        // Check the h2 has the entry title in it
        $this->assertEquals(1, $crawler->filter('h2:contains("' . $entryTitle .'")')->count());
    }
    
    public function testContact()
    {
        $client = static::createClient();
    
        $crawler = $client->request('GET', '/contact');
    
        $this->assertEquals(1, $crawler->filter('h1:contains("Contact us")')->count());
    
        // Select based on button value, or id or name for buttons
        $form = $crawler->selectButton('Submit')->form();
    
        $form['portal_appbundle_enquirytype[name]']       = 'name';
        $form['portal_appbundle_enquirytype[email]']      = 'email@email.com';
        $form['portal_appbundle_enquirytype[subject]']    = 'Subject';
        $form['portal_appbundle_enquirytype[body]']       = 'The comment body must be at least 50 characters long as there is a validation constrain on the Enquiry entity';
    
        $crawler = $client->submit($form);

        // Check email has been sent
        if ($profile = $client->getProfile())
        {
            $swiftMailerProfiler = $profile->getCollector('swiftmailer');

            // Only 1 message should have been sent
            $this->assertEquals(1, $swiftMailerProfiler->getMessageCount());

            // Get the first message
            $messages = $swiftMailerProfiler->getMessages();
            $message  = array_shift($messages);

            $appEmail = $client->getContainer()->getParameter('portal_app.emails.contact_email');
            // Check message is being sent to correct address
            $this->assertArrayHasKey($appEmail, $message->getTo());
        }

        // Need to follow redirect
        $crawler = $client->followRedirect();

        $this->assertTrue($crawler->filter('.entryger-notice:contains("Your contact enquiry was successfully sent. Thank you!")')->count() > 0);
    }
    
}