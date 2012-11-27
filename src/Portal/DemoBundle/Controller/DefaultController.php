<?php
namespace Portal\DemoBundle\Controller;

use Portal\DemoBundle\Form\Model\CatModel;

class DefaultController extends BaseController
{
    public function indexAction()
    {
        $service    = $this->getCatService();
        $form       = $service->getCatForm(new CatModel());

        return $this->render('PortalDemoBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function createAction()
    {
        $service    = $this->getCatService();
        $form       = $service->getCatForm(new CatModel() );

        if (!$this->mediateForm($form)) {
            return $this->render('PortalDemoBundle:Default:index.html.twig', array(
                           'form' => $form->createView(),
            ));
        }

        $pats = $service->patCatByForm($form);
        $this->get('session')->setFlash('pats', $pats);

        return $this->redirect($this->generateUrl('PortalDemoBundle_demo_meoow'));
    }

    public function meoowAction()
    {
        return $this->render('PortalDemoBundle:Default:meoow.html.twig', array(
            'message' => $this->get('session')->getFlash("pats"),
        ));
    }

    /**
     * @return \Portal\DemoBundle\Service\CatService
     */
    protected function getCatService()
    {
        return $this->get('portal_demo.service.cat');
    }
}
