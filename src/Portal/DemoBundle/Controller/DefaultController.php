<?php
namespace Portal\DemoBundle\Controller;

use Portal\DemoBundle\Form\Model\CatModel;

class DefaultController extends BaseController
{
    public function indexAction()
    {
        $service    = $this->getCatService();
        $form       = $service->getCatForm(new CatModel() );

        return $this->render('PortalDemoBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function createAction()
    {
        $self       = $this;
        $service    = $this->getCatService();
        $form       = $service->getCatForm(new CatModel() );

        return $this->processForm($form, function($form) use($self, $service) {

                $pats = $service->patCatByForm($form);
                
                $self->get('session')->setFlash('pats', $pats);

                return $self->createSuccessRedirectResponse('PortalDemoBundle_demo_meoow');
            },
            function($form) use($self) {
                return $self->render('PortalDemoBundle:Default:index.html.twig', array(
                    'form' => $form->createView(),
                ));
            }
        );
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
