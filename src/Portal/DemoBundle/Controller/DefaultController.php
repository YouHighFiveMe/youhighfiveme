<?php
namespace Portal\DemoBundle\Controller;

class DefaultController extends BaseController
{
    public function indexAction()
    {
        return $this->render('PortalDemoBundle:Default:index.html.twig');
    }
}
